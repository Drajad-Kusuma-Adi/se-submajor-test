import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Header from './components/header';
import Login from './components/login';
import Dashboard from './components/dashboard';

function App() {
  return (
    <>
      <Header />
      <Router>
        <Routes>
          <Route path='/' Component={Login} />
          <Route path='/dashboard' Component={Dashboard} />
        </Routes>
      </Router>
    </>
  );
}

export default App;
