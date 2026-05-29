import { useState, useEffect } from 'react';
import BtnBack from '../components/BtnBack';
import './Example4StateHooks.css';

const pokemons = [
  {
    id: 1,
    name: 'Pikachu',
    type: 'Electric',
    power: 'Thunderbolt',
    image: 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/25.png',
    legendary: false,
    level: 5,
    dex: '#025',
    typeColor: '#f7c948',
  },
  {
    id: 2,
    name: 'Mew',
    type: 'Psychic',
    power: 'Shadow Ball',
    image: 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/151.png',
    legendary: true,
    level: 70,
    dex: '#151',
    typeColor: '#e97dd6',
  },
  {
    id: 3,
    name: 'Charmander',
    type: 'Fire',
    power: 'Ember',
    image: 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/4.png',
    legendary: false,
    level: 10,
    dex: '#004',
    typeColor: '#ff6b35',
  },
];

function Example4StateHooks() {
  const [selected, setSelected] = useState(null);
  const [currentHp, setCurrentHp] = useState(100);
  const [captured, setCaptured] = useState({});
  const [battleActive, setBattleActive] = useState(false);
  const [dialogText, setDialogText] = useState('Elige un Pokémon para encontrar!');
  const [buttonsDisabled, setButtonsDisabled] = useState(true);
  const [showCapture, setShowCapture] = useState(false);
  const [throwBall, setThrowBall] = useState(false);
  const [shaking, setShaking] = useState(false);
  const [pokeFainted, setPokeFainted] = useState(false);
  const [infoVisible, setInfoVisible] = useState(false);
  const [capturedPoke, setCapturedPoke] = useState(null);

  const hpPercent = Math.max(0, Math.min(100, currentHp));
  const hpColor = hpPercent < 25 ? '#f44336' : hpPercent < 50 ? '#ffc107' : '#4caf50';

  function selectPokemon(p) {
    setSelected(p);
    setBattleActive(true);
    setCurrentHp(100);
    setShowCapture(false);
    setInfoVisible(false);
    setCapturedPoke(null);
    setPokeFainted(false);
    setDialogText(`¡${p.name.toUpperCase()} salvaje apareció! ¿Qué harás?`);
    setButtonsDisabled(false);
  }

  function doFight() {
    if (!selected || !battleActive) return;
    setButtonsDisabled(true);
    const dmg = selected.legendary
      ? 8 + Math.floor(Math.random() * 10)
      : 15 + Math.floor(Math.random() * 20);
    const newHp = Math.max(0, currentHp - dmg);
    setCurrentHp(newHp);

    const msgs = [
      `¡Usaste ${selected.power}!`,
      '¡Es súper efectivo!',
      `${selected.name.toUpperCase()} recibió ${dmg} de daño!`,
    ];
    let i = 0;
    const t = setInterval(() => {
      setDialogText(msgs[i++]);
      if (i >= msgs.length) {
        clearInterval(t);
        if (newHp <= 0) {
          setDialogText(`${selected.name.toUpperCase()} se debilitó... ¡Escapó!`);
          setBattleActive(false);
          setSelected(null);
          setPokeFainted(true);
        } else {
          setButtonsDisabled(false);
        }
      }
    }, 700);
  }

  function doCatch() {
    if (!selected || !battleActive) return;
    setButtonsDisabled(true);
    setThrowBall(true);

    const catchRate = selected.legendary ? 0.3 : 0.75;
    const success = (hpPercent < 50 ? catchRate + 0.2 : catchRate) > Math.random();

    setTimeout(() => {
      setThrowBall(false);
      if (success) {
        setShowCapture(true);
        setDialogText(`¡Listo! ¡${selected.name.toUpperCase()} fue atrapado!`);
        setCaptured(prev => ({ ...prev, [selected.id]: true }));
        setTimeout(() => {
          setCapturedPoke(selected);
          setInfoVisible(true);
          setBattleActive(false);
          setDialogText('¡Datos añadidos a tu Pokédex!');
        }, 800);
      } else {
        setShaking(true);
        setDialogText(`¡Oh no! ¡${selected.name.toUpperCase()} se liberó! Debilítalo primero.`);
        setTimeout(() => {
          setShaking(false);
          setButtonsDisabled(false);
        }, 600);
      }
    }, 600);
  }

  function doRun() {
    setButtonsDisabled(true);
    setDialogText('¡Escapaste con seguridad!');
    setBattleActive(false);
    setSelected(null);
    setTimeout(() => {
      setCurrentHp(100);
      setShowCapture(false);
      setPokeFainted(false);
      setDialogText('Elige un Pokémon para encontrar!');
    }, 1000);
  }

  function doBag() {
    setDialogText('¡Usaste Poción! Pero no pasó nada...');
  }

  return (
    <div className="container">
      <BtnBack />

      <div className="poke-game-shell">

        {/* Header */}
        <div className="poke-header">
          <span className="poke-title">POKÉMON STATE</span>
          <div className="pokeball-icon">
            <div className="pokeball-line" />
            <div className="pokeball-center" />
          </div>
        </div>

        {/* Battle Scene */}
        <div className="poke-battle-scene">
          <div className="poke-ground enemy-ground" />
          <div className="poke-ground player-ground" />

          {/* Trainer */}
          <div className="poke-trainer">🧢</div>

          {/* Wild Pokemon */}
          <div className={`poke-wild ${showCapture ? 'poke-captured-anim' : ''} ${shaking ? 'poke-shake' : ''}`}>
            {selected && (
              <img
                src={selected.image}
                alt={selected.name}
                className={pokeFainted ? 'poke-fainted' : ''}
              />
            )}
          </div>

          {/* HP Bar */}
          {selected && (
            <div className="poke-hp-box">
              <div className="poke-hp-name">
                <span>{selected.name.toUpperCase()}</span>
                <span>Lv.{selected.level}</span>
              </div>
              <div className="poke-hp-track">
                <div
                  className="poke-hp-fill"
                  style={{ width: `${hpPercent}%`, background: hpColor }}
                />
              </div>
            </div>
          )}

          {/* Pokeball throw animation */}
          {throwBall && <div className="poke-throw-ball">⚪</div>}
        </div>

        {/* Dialog */}
        <div className="poke-dialog">
          <p className="poke-dialog-text">
            {dialogText}
            <span className="poke-cursor" />
          </p>
        </div>

        {/* Pokemon Select Grid */}
        <div className="poke-select-area">
          <div className="poke-select-label">▶ SELECCIONA POKÉMON</div>
          <div className="poke-grid">
            {pokemons.map(p => (
              <div
                key={p.id}
                className={`poke-card ${captured[p.id] ? 'poke-card-captured' : ''} ${selected && selected.id === p.id ? 'poke-card-selected' : ''}`}
                onClick={() => selectPokemon(p)}
              >
                {captured[p.id] && <span className="poke-captured-badge">✓</span>}
                <img src={p.image} alt={p.name} />
                <div className="poke-card-name">{p.name}</div>
                <div
                  className="poke-card-type"
                  style={{ background: `${p.typeColor}22`, color: p.typeColor, border: `1px solid ${p.typeColor}55` }}
                >
                  {p.type}
                </div>
              </div>
            ))}
          </div>
        </div>

        {/* Action Buttons */}
        <div className="poke-actions">
          <button className="poke-btn" onClick={doFight} disabled={buttonsDisabled || !battleActive}>
            <span>⚔️</span>FIGHT
          </button>
          <button className="poke-btn" onClick={doCatch} disabled={buttonsDisabled || !battleActive}>
            <span>⚪</span>CATCH
          </button>
          <button className="poke-btn" onClick={doRun} disabled={!battleActive && !selected}>
            <span>💨</span>RUN
          </button>
          <button className="poke-btn" onClick={doBag} disabled={buttonsDisabled || !battleActive}>
            <span>🎒</span>BAG
          </button>
        </div>

        {/* Info Panel (shown after capture) */}
        {infoVisible && capturedPoke && (
          <div className="poke-info-panel">
            <div className="poke-info-header">
              <img src={capturedPoke.image} alt={capturedPoke.name} className="poke-info-img" />
              <div>
                <div className="poke-info-name">{capturedPoke.name.toUpperCase()}</div>
                <div className="poke-info-id">National Dex {capturedPoke.dex}</div>
                {capturedPoke.legendary && (
                  <span className="poke-legendary-badge">★ LEGENDARIO</span>
                )}
                <div
                  className="poke-type-pill"
                  style={{
                    background: `${capturedPoke.typeColor}33`,
                    color: capturedPoke.typeColor,
                    border: `1px solid ${capturedPoke.typeColor}77`,
                  }}
                >
                  {capturedPoke.type}
                </div>
              </div>
            </div>
            <div className="poke-info-rows">
              <div className="poke-info-row">
                <div className="poke-info-label">TIPO</div>
                <div className="poke-info-val">{capturedPoke.type}</div>
              </div>
              <div className="poke-info-row">
                <div className="poke-info-label">PODER</div>
                <div className="poke-info-val">{capturedPoke.power}</div>
              </div>
              <div className="poke-info-row">
                <div className="poke-info-label">ESTADO</div>
                <div className="poke-info-val poke-status-ok">CAPTURADO ✓</div>
              </div>
              <div className="poke-info-row">
                <div className="poke-info-label">DEX No.</div>
                <div className="poke-info-val">{capturedPoke.dex}</div>
              </div>
            </div>
          </div>
        )}

      </div>
    </div>
  );
}

export default Example4StateHooks;