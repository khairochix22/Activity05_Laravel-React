//import logo from "./logo.svg";
import "./App.css";
import MyButton from "./components/Button";
import Card from "./components/Card";
import Counter from "./components/Counter";
import Form from "./components/Form";
import List from "./components/List";
 
function App() {
  return (
    <div className="App">
      <MyButton />
      <Card name="Markyy" description="Kindddddddddesss" />
      <Form />
      <Counter />
      <List />
    </div>
  );
}
 
export default App;