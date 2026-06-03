import { useState } from 'react';
import BtnBack from '../components/BtnBack';

function Example6CondicionalListas() {
    const [pcBox, setPcBox] = useState([
        { id: 1, name: 'Pidgey', level: 3, type: 'Normal/Flying' },
        { id: 2, name: 'Rattata', level: 2, type: 'Normal' },
        { id: 3, name: 'Zubat', level: 4, type: 'Poison/Flying' },
        { id: 4, name: 'Geodude', level: 5, type: 'Rock/Ground' },
    ]);

    const [typeFilter, setTypeFilter] = useState('all');
    const [showOnlyHighLevel, setShowOnlyHighLevel] = useState(false);

    // Estilos modo oscuro
    const containerFilters = {
        backgroundColor: '#1e1e2e',
        padding: '25px',
        borderRadius: '12px',
        boxShadow: '0 4px 12px rgba(0,0,0,0.5)',
        marginBottom: '20px',
        border: '1px solid #313244'
    };

    const buttonStyle = {
        backgroundColor: '#89b4fa',
        color: '#1e1e2e',
        border: 'none',
        padding: '10px 20px',
        borderRadius: '8px',
        cursor: 'pointer',
        boxShadow: '0 2px 6px rgba(0,0,0,0.3)',
        fontSize: '14px',
        fontWeight: 'bold'
    };

    const boxPokemons = {
        backgroundColor: '#2a2a3a',
        padding: '40px 20px',
        borderRadius: '12px',
        textAlign: 'center',
        marginTop: '20px',
        color: '#cdd6f4',
        border: '1px solid #45475a'
    };

    const boxPK = {
        backgroundColor: '#181825',
        padding: '20px',
        borderRadius: '12px',
        width: '200px',
        textAlign: 'center',
        boxShadow: '0 4px 12px rgba(0,0,0,0.4)',
        border: '1px solid #313244',
        transition: 'transform 0.2s'
    };

    const releaseButton = {
        backgroundColor: '#f38ba8',
        color: '#1e1e2e',
        border: 'none',
        padding: '8px 16px',
        borderRadius: '8px',
        cursor: 'pointer',
        marginTop: '15px',
        fontSize: '14px',
        fontWeight: 'bold',
        width: '100%'
    };

    const selectStyle = {
        padding: '10px',
        borderRadius: '8px',
        border: '1px solid #45475a',
        fontSize: '14px',
        backgroundColor: '#313244',
        color: '#cdd6f4',
        cursor: 'pointer'
    };

    const labelStyle = {
        display: 'flex',
        alignItems: 'center',
        gap: '8px',
        color: '#cdd6f4'
    };

    const counterStyle = {
        backgroundColor: '#313244',
        padding: '10px',
        borderRadius: '8px',
        marginBottom: '15px',
        color: '#89b4fa'
    };

    // Release a pokemon
    const releasePokemon = (id) => {
        setPcBox(pcBox.filter(pokemon => pokemon.id !== id));
    };

    // Add a random Pokemon
    const addPokemon = () => {
        const newPokemon = [
            { name: 'Caterpie', level: 2, type: 'Bug' },
            { name: 'Weedle', level: 2, type: 'Bug/Poison' },
            { name: 'Pidgeotto', level: 8, type: 'Normal/Flying' },
        ];
        const random = newPokemon[Math.floor(Math.random() * newPokemon.length)];
        setPcBox([...pcBox, { ...random, id: Date.now() }]);
    };

    // Filter Pokemon
    const filteredPokemon = pcBox.filter(pokemon => {
        if (typeFilter !== 'all' && !pokemon.type.toLowerCase().includes(typeFilter)) {
            return false;
        }
        if (showOnlyHighLevel && pokemon.level < 4) {
            return false;
        }
        return true;
    });

    return (
        <div className="container" style={{ backgroundColor: '#1a1a26', minHeight: '100vh' }}>
            <BtnBack />
            <h2 style={{ marginBottom: '5px', color: '#cdd6f4' }}>Example 6 - Conditional Rendering</h2>
            <p style={{ marginBottom: '20px', color: '#a6adc8' }}>Show or hide UI elements based on state.</p>

            <div style={containerFilters}>
                <h3 style={{ marginBottom: '15px', color: '#89b4fa' }}> Filters</h3>
                <div style={{ display: 'flex', gap: '20px', flexWrap: 'wrap', alignItems: 'center' }}>
                    <select
                        value={typeFilter}
                        onChange={(e) => setTypeFilter(e.target.value)}
                        style={selectStyle}
                    >
                        <option value="all"> All Types</option>
                        <option value="normal"> Normal</option>
                        <option value="flying"> Flying</option>
                        <option value="poison"> Poison</option>
                        <option value="bug"> Bug</option>
                        <option value="rock"> Rock</option>
                    </select>
                    
                    <label style={labelStyle}>
                        <input
                            style={{ width: '18px', height: '18px', cursor: 'pointer', accentColor: '#89b4fa' }}
                            type="checkbox"
                            checked={showOnlyHighLevel}
                            onChange={(e) => setShowOnlyHighLevel(e.target.checked)}
                        />
                        <span> Show only level 4+</span>
                    </label>

                    <button onClick={addPokemon} style={buttonStyle}>
                         Random Pokemon
                    </button>
                </div>
            </div>

            {/* Conditional Rendering */}
            {filteredPokemon.length === 0 ? (
                <div style={boxPokemons}>
                    <h3 style={{ fontSize: '24px', marginBottom: '10px', color: '#f9e2af' }}> The box is empty</h3>
                    <p style={{ fontSize: '16px' }}>No pokemon match the selected filters.</p>
                </div>
            ) : (
                <div style={{ marginTop: '20px' }}>
                    <p style={counterStyle}>
                        <strong> Showing {filteredPokemon.length} of {pcBox.length} Pokemon</strong>
                    </p>
                    <div style={{ display: 'flex', flexWrap: 'wrap', gap: '20px' }}>
                        {filteredPokemon.map(pokemon => (
                            <div key={pokemon.id} style={boxPK}>
                                <h4 style={{ 
                                    fontSize: '20px', 
                                    marginBottom: '10px',
                                    color: '#89b4fa'
                                }}>
                                    {pokemon.name}
                                </h4>
                                <p style={{ margin: '8px 0', fontSize: '14px', color: '#cdd6f4' }}>
                                    <strong>Level:</strong> {pokemon.level}
                                </p>
                                <p style={{ margin: '8px 0', fontSize: '14px', color: '#a6adc8' }}>
                                    <strong>Type:</strong> {pokemon.type}
                                </p>
                                <button onClick={() => releasePokemon(pokemon.id)} style={releaseButton}>
                                    ✖ Release
                                </button>
                            </div>
                        ))}
                    </div>
                </div>
            )}
        </div>
    );
}

export default Example6CondicionalListas;