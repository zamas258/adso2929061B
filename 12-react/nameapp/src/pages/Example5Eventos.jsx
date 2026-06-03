import { useState } from "react";
import BtnBack from "../components/BtnBack";

function Example5Eventos() {
    const [chosenPokemon, setChosenPokemon] = useState(null);
    const [hoveredPokemon, setHoveredPokemon] = useState(null);
    const [inputRange, setInputRange] = useState(50);

    // Estilos simples con buenas sombras
    const eventContainer = {
        backgroundColor: '#fff',
        padding: '25px',
        borderRadius: '12px',
        marginTop: '20px',
        boxShadow: '0 8px 16px rgba(0,0,0,0.1)'
    };

    const titleH3 = {
        color: '#333',
        borderLeft: '4px solid #007bff',
        paddingLeft: '12px',
        marginTop: '20px',
        marginBottom: '15px'
    };

    const btnsClick = {
        display: 'flex',
        gap: '12px',
        justifyContent: 'center',
        margin: '15px 0',
        flexWrap: 'wrap'
    };

    const buttonStyle = {
        backgroundColor: '#007bff',
        color: 'white',
        border: 'none',
        padding: '10px 20px',
        borderRadius: '8px',
        cursor: 'pointer',
        fontSize: '16px',
        display: 'flex',
        alignItems: 'center',
        gap: '8px',
        boxShadow: '0 2px 4px rgba(0,0,0,0.2)'
    };

    const chosePokemon = {
        backgroundColor: '#f8f9fa',
        padding: '12px',
        borderRadius: '8px',
        textAlign: 'center',
        marginTop: '15px',
        fontWeight: 'bold',
        color: '#333',
        boxShadow: '0 2px 4px rgba(0,0,0,0.05)'
    };

    const hoverStyle = {
        backgroundColor: '#6f42c1',
        color: 'white',
        border: 'none',
        padding: '10px 20px',
        borderRadius: '8px',
        cursor: 'pointer',
        display: 'flex',
        alignItems: 'center',
        gap: '10px',
        boxShadow: '0 2px 4px rgba(0,0,0,0.2)'
    };

    const rangeStyle = {
        width: '100%',
        margin: '10px 0'
    };

    const outPut = {
        backgroundColor: '#e9ecef',
        padding: '15px',
        borderRadius: '8px',
        textAlign: 'center',
        fontSize: '24px',
        fontWeight: 'bold',
        marginTop: '10px',
        color: '#007bff',
        boxShadow: '0 2px 4px rgba(0,0,0,0.05)'
    };

    const handleChoice = (name) => {
        setChosenPokemon(name);
    }
    
    const handleMouseEnter = (name) => {
        setHoveredPokemon(name);
    }

    const handleMouseLeave = () => {
        setHoveredPokemon(null);
    }

    const handleInput = (e) => {
        setInputRange(e.target.value);
    }

    return (
        <div className="container">
            <BtnBack />
            <h2>Example 5 - Event Handling</h2>
            <p>Respond to user interactions (click, hover, input, submit).</p>
            
            <div style={eventContainer}>
                {/* Click Event */}
                <h3 style={titleH3}>Click Event:</h3>
                <div style={btnsClick}>
                    <button onClick={() => handleChoice("Bulbasaur")} style={buttonStyle}>
                        <span>🌱</span> Bulbasaur
                    </button>
                    <button onClick={() => handleChoice("Charmander")} style={buttonStyle}>
                        <span>🔥</span> Charmander
                    </button>
                    <button onClick={() => handleChoice("Squirtle")} style={buttonStyle}>
                        <span>💧</span> Squirtle
                    </button>
                </div>
                
                {chosenPokemon ? (
                    <div style={chosePokemon}>✨ You chose {chosenPokemon} ✨</div>
                ) : (
                    <div style={chosePokemon}>❓ Please choose a pokemon</div>
                )}

                {/* MouseEnter/MouseLeave Events */}
                <h3 style={titleH3}>MouseEnter/MouseLeave Events:</h3>
                <div style={btnsClick}>
                    <button
                        onMouseEnter={() => handleMouseEnter("Pikachu")}
                        onMouseLeave={handleMouseLeave}
                        style={hoverStyle}>
                        Hover here!
                        <img style={{width: '40px'}} 
                             src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/25.png" 
                             alt="pikachu" />
                    </button>
                    <button
                        onMouseEnter={() => handleMouseEnter("Eevee")}
                        onMouseLeave={handleMouseLeave}
                        style={hoverStyle}>
                        Hover here too!
                        <img style={{width: '40px'}} 
                             src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/133.png" 
                             alt="eevee" />
                    </button>
                </div>
                
                {hoveredPokemon && (
                    <div style={chosePokemon}>🐾 You are viewing: {hoveredPokemon}</div>
                )}

                {/* Input Event */}
                <h3 style={titleH3}>Input Event:</h3>
                <input 
                    style={rangeStyle}
                    onInput={handleInput}
                    type="range" 
                    min="0"
                    max="100"
                />
                <span style={{display: "block", textAlign: "center", marginTop: '10px'}}>
                    Power: {inputRange}
                </span>
                
                {inputRange && (
                    <div style={outPut}>
                        {inputRange}%
                    </div>
                )}
            </div>
        </div>
    );
}

export default Example5Eventos;