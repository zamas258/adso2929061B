import { Routes, Route, Link, useLocation, Navigate } from 'react-router-dom';
import BtnBack from '../components/BtnBack';

function GeneralInfo() {
  return (
    <div style={stylesGeneralInfo}>
      <h3>ℹ️ General Information</h3>
      <p>
        Welcome to the Pokémon region. Here you'll find basic information
        about the Pokémon world.
      </p>
      <ul>
        <li>Regions: Kanto, Johto, Hoenn, Sinnoh</li>
        <li>Types: 18 different types</li>
        <li>Known Pokémon: 898+</li>
      </ul>
    </div>
  );
}

function PokemonList() {
  const pokemonList = [
    'Bulbasaur',
    'Charmander',
    'Squirtle',
    'Pikachu',
    'Eevee',
  ];

  return (
    <div style={stylesPokemonList}>
      <h3>📋 Starter Pokémon</h3>
      <ul>
        {pokemonList.map((pokemon, index) => (
          <li key={index}>{pokemon}</li>
        ))}
      </ul>
    </div>
  );
}

function PokemonDetails() {
  const location = useLocation();
  const searchParams = new URLSearchParams(location.search);
  const pokemon = searchParams.get('name') || 'unknown';

  return (
    <div style={stylesPokemonDetails}>
      <h3>🔍 Pokémon Details</h3>
      <p>
        Showing details for: <strong>{pokemon}</strong>
      </p>
      {pokemon !== 'unknown' && (
        <div>
          <p>Additional information about {pokemon}...</p>
          <img
            src={`https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/${
              pokemon === 'Pikachu' ? '25' : 
              pokemon === 'Charmander' ? '4' : 
              pokemon === 'Bulbasaur' ? '1' : 
              pokemon === 'Squirtle' ? '7' :
              pokemon === 'Eevee' ? '133' : '25'
            }.png`}
            alt={pokemon}
            style={{ width: '160px' }}
          />
        </div>
      )}
    </div>
  );
}

function Example7Routing() {
  const location = useLocation();
  
  return (
    <div className="container" style={containerStyle}>
      <BtnBack />

      <h2 style={titleStyle}>Example 7: React Router</h2>

      <p style={subtitleStyle}>
        Navigation between different 'pages' without reloading the browser.
      </p>

      {/* Menú de navegación */}
      <nav style={stylesMenu}>
        <Link to="/" style={linkStyle}>
          🏠 Home
        </Link>

        <Link to="/list" style={linkStyle}>
          📄 List
        </Link>

        <Link to="/details?name=Pikachu" style={linkStyle}>
          ⚡ Pikachu
        </Link>

        <Link to="/details?name=Charmander" style={linkStyle}>
          🔥 Charmander
        </Link>

        <Link to="/details?name=Bulbasaur" style={linkStyle}>
          🌱 Bulbasaur
        </Link>

        <Link to="/details?name=Squirtle" style={linkStyle}>
          💧 Squirtle
        </Link>

        <Link to="/details?name=Eevee" style={linkStyle}>
          🦊 Eevee
        </Link>
      </nav>

      {/* Contenido que cambia según la ruta */}
      <div style={{ marginTop: '20px' }}>
        {location.pathname === '/' && <GeneralInfo />}
        {location.pathname === '/list' && <PokemonList />}
        {location.pathname === '/details' && <PokemonDetails />}
      </div>
    </div>
  );
}

// ========== ESTILOS ==========

const containerStyle = {
  backgroundColor: '#1a1a26',
  minHeight: '100vh',
  padding: '20px',
  borderRadius: '0'
};

const titleStyle = {
  color: '#cdd6f4',
  marginBottom: '5px'
};

const subtitleStyle = {
  color: '#a6adc8',
  marginBottom: '20px'
};

const stylesGeneralInfo = {
  backgroundColor: '#181825',
  padding: '20px',
  borderRadius: '12px',
  marginTop: '20px',
  boxShadow: '0 4px 12px rgba(0,0,0,0.3)',
  border: '1px solid #313244',
  color: '#cdd6f4'
};

const stylesPokemonList = {
  padding: '20px',
  background: '#181825',
  color: '#cdd6f4',
  borderRadius: '12px',
  marginTop: '20px',
  border: '1px solid #313244',
  boxShadow: '0 4px 12px rgba(0,0,0,0.3)'
};

const stylesPokemonDetails = {
  padding: '20px',
  background: '#181825',
  color: '#cdd6f4',
  borderRadius: '12px',
  marginTop: '20px',
  border: '1px solid #313244',
  boxShadow: '0 4px 12px rgba(0,0,0,0.3)'
};

const stylesMenu = {
  backgroundColor: '#1e1e2e',
  padding: '15px',
  borderRadius: '12px',
  marginTop: '20px',
  border: '1px solid #313244',
  display: 'flex',
  gap: '15px',
  justifyContent: 'center',
  flexWrap: 'wrap'
};

const linkStyle = {
  textDecoration: 'none',
  color: '#89b4fa',
  fontWeight: 'bold',
  padding: '10px 20px',
  borderRadius: '8px',
  backgroundColor: '#313244',
  transition: 'all 0.3s',
  display: 'inline-block',
  boxShadow: '0 2px 4px rgba(0,0,0,0.2)'
};

export default Example7Routing;