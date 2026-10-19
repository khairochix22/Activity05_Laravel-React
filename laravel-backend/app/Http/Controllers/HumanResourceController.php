<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HumanResourceController extends Controller
{
    public function payroll(Request $request)
    {
        $age = $request->age;

        return response()->json([
            'age' => $age,

        ]);

    }

    public function calculate(Request $request)
    {
        $type = $request->input('employmentType');
        $tier = $request->input('positionTier');

        $absent = $request->input('daysAbsent');
        $late = $request->input('minutesLate');
        $ot = $request->input('overtimeHours');

        $salaryData = [
            'COS' => [
                'baseSalary' => 18000,
                'sss' => 0,
                'philhealth' => 0,
                'pagibig' => 0,
            ],
            'Regular' => [
                'Junior' => [
                    'baseSalary' => 25000,
                    'sss' => 1125,
                    'philhealth' => 625,
                    'pagibig' => 200,
                ],
                'Senior' => [
                    'baseSalary' => 40000,
                    'sss' => 1800,
                    'philhealth' => 1000,
                    'pagibig' => 200,
                ],
            ],
        ];

        if ($type === 'COS') {
            $payInfo = $salaryData['COS'];
        } elseif (
            isset($salaryData[$type]) &&
            isset($salaryData[$type][$tier])
        ) {
            $payInfo = $salaryData[$type][$tier];
        } else {
            return response()->json([
                'message' => 'Invalid Employment Type or Position Tier',
            ], 400);
        }

        $baseSalary = $payInfo['baseSalary'];

        $sss = $payInfo['sss'];
        $philhealth = $payInfo['philhealth'];
        $pagibig = $payInfo['pagibig'];

        $workingDays = 22;
        $workingHours = 8;
        $overtimeMultiplier = 1.25;
        $dailyRate = $baseSalary / $workingDays;
        $hourlyRate = $dailyRate / $workingHours;
        $daysPresent = $workingDays - $absent;
        $absentDeduction = $absent * $dailyRate;
        $lateDeduction = ($late / 60) * $hourlyRate;
        $overtimePay = $ot * $hourlyRate * $overtimeMultiplier;
        $grossPay = ($baseSalary + $overtimePay)
                  - ($absentDeduction + $lateDeduction);

        $totalDeductions = $sss + $philhealth + $pagibig;
        $netPay = $grossPay - $totalDeductions;

        return response()->json([
            'daysAbsent' => $absent,
            'employmentType' => $type,
            'positionTier' => $tier,
            'baseSalary' => $baseSalary,
            'daysPresent' => $daysPresent,
            'dailyRate' => round($dailyRate, 2),
            'hourlyRate' => round($hourlyRate, 2),
            'lateDeduction' => round($lateDeduction, 2),
            'absentDeduction' => round($absentDeduction, 2),
            'overtimePay' => round($overtimePay, 2),
            'grossPay' => round($grossPay, 2),
            'sss' => $sss,
            'philhealth' => $philhealth,
            'pagibig' => $pagibig,
            'totalDeductions' => $totalDeductions,
            'netPay' => round($netPay, 2),
        ]);
    }
}
