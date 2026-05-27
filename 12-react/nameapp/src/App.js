import { BrowserRouter, Routes, Route } from 'react-router-dom';
import './App.css';
import Menu from './components/Menu';
import Example1Components from './pages/Example1Components';
import Example2JSX from './pages/Example2JSX';
import Example3Props from '.pages/Example3Props';
import Example4StateHooks from './pages/Example4StateHooks';
import Example5Events from './pages/ExampleEvents';
import Example6ConditionalLists from './pages/Example6ConditionalsLists';
import Example7Routing from './pages/Example7Routing';
import Example8DataFetching from './pages/Example8DataFetching';

function App() {
  return (
    <BrowserRouter>
       <div className="App">
        <Routes>
          <Route path="/" element={<Menu />} />
          <Route path="xample1" element={<Example1Componets         />} />
          <Route path="xample2" element={<Example2JSX               />} />
          <Route path="xample1" element={<Example3Props             />} />
          <Route path="xample1" element={<Example4StateHooks        />} />
          <Route path="xample1" element={<Example5Events            />} />
          <Route path="xample1" element={<Example6ConditionalLists  />} />
          <Route path="xample1" element={<Example7Routing           />} />
          <Route path="xample1" element={<Example8DataFetching      />} />
          </Routes>
          </div>
          </BrowserRouter>
  );
}

export default App;