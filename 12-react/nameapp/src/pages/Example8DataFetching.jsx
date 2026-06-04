import { useState, useEffect } from "react";

const AFFILIATION_COLORS = {
  "Z Fighter": "#1565c0",
  "Villain": "#b71c1c",
  "Deity": "#6a1b9a",
  "Army of Frieza": "#4e342e",
  "Red Ribbon Army": "#c62828",
  "Namekian Warrior": "#2e7d32",
};

const RACE_COLORS = {
  "Saiyan": "#f57c00",
  "Human": "#1976d2",
  "Namekian": "#388e3c",
  "Frieza Race": "#7b1fa2",
  "Android": "#0097a7",
  "Bio-Android": "#00796b",
  "Majin": "#e91e63",
  "God": "#fbc02d",
  "Angel": "#80deea",
};

function getRaceColor(race) {
  if (!race) return "#888";
  for (const key of Object.keys(RACE_COLORS)) {
    if (race.toLowerCase().includes(key.toLowerCase())) return RACE_COLORS[key];
  }
  return "#546e7a";
}

function getAffiliationColor(aff) {
  return AFFILIATION_COLORS[aff] || "#37474f";
}

function capitalize(s) {
  return s ? s.charAt(0).toUpperCase() + s.slice(1) : "";
}

function StatBar({ label, value, max = 10000000000 }) {
  const numVal = parseFloat(String(value).replace(/[^0-9.]/g, "")) || 0;
  const pct = Math.min(100, (numVal / max) * 100);
  return (
    <div style={{ marginBottom: 5 }}>
      <div style={{ display: "flex", justifyContent: "space-between", color: "#8ab4c4", fontSize: 10, marginBottom: 2 }}>
        <span>{label}</span>
        <span style={{ color: "#fff" }}>{value || "?"}</span>
      </div>
      <div style={{ background: "#0d2137", borderRadius: 4, height: 5 }}>
        <div style={{ width: `${pct || 10}%`, background: pct > 70 ? "#f44336" : pct > 40 ? "#ff9800" : "#4fc3f7", height: 5, borderRadius: 4, transition: "width 0.4s" }} />
      </div>
    </div>
  );
}

function Row({ label, value }) {
  return (
    <div style={{ display: "flex", justifyContent: "space-between", marginBottom: 5, gap: 8 }}>
      <span style={{ color: "#8ab4c4", fontSize: 11, whiteSpace: "nowrap" }}>{label}:</span>
      <span style={{ color: "#fff", fontSize: 11, textAlign: "right" }}>{value || "Unknown"}</span>
    </div>
  );
}

function navBtnStyle(disabled) {
  return {
    background: disabled ? "#0d2137" : "#1565c0",
    border: "1px solid #1a3a5c",
    color: disabled ? "#3a5a7a" : "#fff",
    borderRadius: 6,
    width: 28, height: 28,
    cursor: disabled ? "default" : "pointer",
    fontSize: 14,
    display: "flex", alignItems: "center", justifyContent: "center",
    padding: 0,
  };
}

export default function Example8DataFetching() {
  const [characters, setCharacters] = useState([]);
  const [selected, setSelected] = useState(null);
  const [currentPage, setCurrentPage] = useState(1);
  const [loading, setLoading] = useState(true);

  const PER_PAGE = 24;

  const fallback = [
    { id: 1, name: "Goku", race: "Saiyan", ki: "10 Billion", maxKi: "90 Billion", gender: "Male", affiliation: "Z Fighter", description: "El protagonista principal de Dragon Ball.", image: "https://dragonball-api.com/characters/goku_normal.webp" },
    { id: 2, name: "Vegeta", race: "Saiyan", ki: "9 Billion", maxKi: "85 Billion", gender: "Male", affiliation: "Z Fighter", description: "El príncipe de los Saiyans.", image: "https://dragonball-api.com/characters/vegeta_normal.webp" },
    { id: 3, name: "Gohan", race: "Saiyan", ki: "8 Billion", maxKi: "80 Billion", gender: "Male", affiliation: "Z Fighter", description: "Hijo de Goku y Chi-Chi.", image: "https://dragonball-api.com/characters/gohan_normal.webp" },
    { id: 4, name: "Piccolo", race: "Namekian", ki: "6 Billion", maxKi: "60 Billion", gender: "Male", affiliation: "Z Fighter", description: "Guerrero Namekiano.", image: "https://dragonball-api.com/characters/piccolo_normal.webp" },
    { id: 5, name: "Frieza", race: "Frieza Race", ki: "12 Billion", maxKi: "120 Billion", gender: "Male", affiliation: "Villain", description: "El tirano espacial.", image: "https://dragonball-api.com/characters/Freezer_normal.webp" },
    { id: 6, name: "Cell", race: "Bio-Android", ki: "9 Billion", maxKi: "90 Billion", gender: "Male", affiliation: "Villain", description: "Bio-androide perfecto.", image: "https://dragonball-api.com/characters/cell_normal.webp" },
    { id: 7, name: "Majin Buu", race: "Majin", ki: "8.5 Billion", maxKi: "85 Billion", gender: "Male", affiliation: "Villain", description: "Ser mágico destructor.", image: "https://dragonball-api.com/characters/buu_normal.webp" },
    { id: 8, name: "Trunks", race: "Saiyan", ki: "7.5 Billion", maxKi: "75 Billion", gender: "Male", affiliation: "Z Fighter", description: "Hijo de Vegeta del futuro.", image: "https://dragonball-api.com/characters/trunks_normal.webp" },
    { id: 9, name: "Krillin", race: "Human", ki: "2 Billion", maxKi: "20 Billion", gender: "Male", affiliation: "Z Fighter", description: "Mejor amigo de Goku.", image: "https://dragonball-api.com/characters/Krillin_normal.webp" },
    { id: 10, name: "Beerus", race: "God of Destruction", ki: "Unlimited", maxKi: "Unlimited", gender: "Male", affiliation: "Deity", description: "Dios de la Destrucción.", image: "https://dragonball-api.com/characters/beerus_normal.webp" },
  ];

  useEffect(() => {
    const fetch_ = async () => {
      setLoading(true);
      try {
        const res = await fetch("https://dragonball-api.com/api/characters?limit=100");
        if (res.ok) {
          const data = await res.json();
          const list = Array.isArray(data) ? data : (data.items ?? []);
          setCharacters(list.length > 0 ? list : fallback);
        } else {
          setCharacters(fallback);
        }
      } catch {
        setCharacters(fallback);
      } finally {
        setLoading(false);
      }
    };
    fetch_();
  }, []);

  const start = (currentPage - 1) * PER_PAGE;
  const pageChars = characters.slice(start, start + PER_PAGE);
  const totalPages = Math.ceil(characters.length / PER_PAGE);

  const rows = [];
  for (let i = 0; i < pageChars.length; i += 4) rows.push(pageChars.slice(i, i + 4));

  return (
    <div style={{ backgroundColor: "#0d1b2a", minHeight: "100vh", padding: "20px", fontFamily: "Arial, sans-serif" }}>
      <button onClick={() => window.history.back()} style={{ background: "none", border: "none", color: "#4fc3f7", cursor: "pointer", fontSize: 22, marginBottom: 10 }}>
        ←
      </button>

      <h2 style={{ color: "#fff", margin: "0 0 4px", fontSize: 22 }}>Example 8: Data Fetching</h2>
      <p style={{ color: "#8ab4c4", margin: "0 0 20px", fontSize: 13 }}>
        Connect with external APIs to get real data from Dragon Ball universe.
      </p>

      <div style={{ display: "flex", gap: 16, flexWrap: "wrap", alignItems: "flex-start" }}>
        {/* GRID PANEL */}
        <div style={{ flex: "1 1 360px", backgroundColor: "#0a2540", borderRadius: 12, padding: 16, border: "1px solid #1a3a5c" }}>
          <div style={{ display: "flex", justifyContent: "space-between", alignItems: "center", marginBottom: 14 }}>
            <h3 style={{ color: "#fff", margin: 0, fontSize: 15 }}>
              🐉 Dragon Ball{" "}
              <span style={{ color: "#8ab4c4", fontWeight: 400 }}>(Page {currentPage})</span>
            </h3>
            <div style={{ display: "flex", gap: 6 }}>
              <button onClick={() => setCurrentPage(p => Math.max(1, p - 1))} disabled={currentPage === 1} style={navBtnStyle(currentPage === 1)}>←</button>
              <button onClick={() => setCurrentPage(p => Math.min(totalPages, p + 1))} disabled={currentPage === totalPages} style={navBtnStyle(currentPage === totalPages)}>→</button>
            </div>
          </div>

          {loading ? (
            <div style={{ color: "#8ab4c4", textAlign: "center", padding: 40 }}>Cargando personajes...</div>
          ) : (
            <table style={{ width: "100%", borderCollapse: "collapse" }}>
              <tbody>
                {rows.map((row, ri) => (
                  <tr key={ri}>
                    {row.map((char) => {
                      const isSel = selected?.id === char.id;
                      return (
                        <td key={char.id} style={{ padding: 4, width: "25%" }}>
                          <div
                            onClick={() => setSelected(char)}
                            style={{
                              backgroundColor: isSel ? "#1565c0" : "#0d2137",
                              border: `1px solid ${isSel ? "#4fc3f7" : "#1a3a5c"}`,
                              borderRadius: 8, padding: "8px 4px",
                              cursor: "pointer", textAlign: "center",
                              transition: "background 0.15s",
                            }}
                          >
                            <div style={{ color: "#f57c00", fontSize: 10, marginBottom: 2 }}>#{char.id}</div>
                            <img
                              src={char.image}
                              alt={char.name}
                              style={{ width: 52, height: 52, objectFit: "contain" }}
                              onError={e => { e.target.src = "https://via.placeholder.com/52/0d2137/f57c00?text=DB"; }}
                            />
                            <div style={{ color: "#fff", fontSize: 11, marginTop: 2, fontWeight: "bold" }}>{char.name}</div>
                            <div style={{ color: "#8ab4c4", fontSize: 9, marginTop: 1 }}>{char.race}</div>
                          </div>
                        </td>
                      );
                    })}
                    {row.length < 4 && [...Array(4 - row.length)].map((_, i) => <td key={`e${i}`} style={{ width: "25%" }} />)}
                  </tr>
                ))}
              </tbody>
            </table>
          )}
        </div>

        {/* DETAIL PANEL */}
        <div style={{ flex: "0 0 200px", backgroundColor: "#0a2540", borderRadius: 12, padding: 16, border: "1px solid #1a3a5c" }}>
          <h3 style={{ color: "#fff", margin: "0 0 12px", fontSize: 15 }}>Details</h3>

          {!selected ? (
            <div style={{ color: "#8ab4c4", fontSize: 13, textAlign: "center", paddingTop: 20 }}>
              Selecciona un personaje
            </div>
          ) : (
            <div style={{ textAlign: "center" }}>
              <img
                src={selected.image}
                alt={selected.name}
                style={{ width: 100, height: 100, objectFit: "contain" }}
                onError={e => { e.target.src = "https://via.placeholder.com/100/0d2137/f57c00?text=DB"; }}
              />
              <div style={{ color: "#fff", fontWeight: "bold", fontSize: 16, margin: "8px 0 12px" }}>
                {selected.name}
              </div>

              <div style={{ textAlign: "left" }}>
                <Row label="Race" value={selected.race} />
                <Row label="Gender" value={selected.gender} />

                <div style={{ marginBottom: 5 }}>
                  <span style={{ color: "#8ab4c4", fontSize: 11 }}>Affiliation: </span>
                  <span style={{
                    background: getAffiliationColor(selected.affiliation),
                    color: "#fff", fontSize: 9, padding: "2px 7px",
                    borderRadius: 20, display: "inline-block", marginTop: 2,
                  }}>
                    {selected.affiliation || "Unknown"}
                  </span>
                </div>

                <div style={{ marginBottom: 5 }}>
                  <span style={{ color: "#8ab4c4", fontSize: 11 }}>Race type: </span>
                  <span style={{
                    background: getRaceColor(selected.race),
                    color: "#fff", fontSize: 9, padding: "2px 7px",
                    borderRadius: 20, display: "inline-block",
                  }}>
                    {selected.race || "Unknown"}
                  </span>
                </div>

                <div style={{ marginTop: 10, marginBottom: 8 }}>
                  <StatBar label="Ki" value={selected.ki} />
                  <StatBar label="Max Ki" value={selected.maxKi} />
                </div>

                {selected.description && (
                  <div style={{ color: "#8ab4c4", fontSize: 10, lineHeight: 1.5, borderTop: "1px solid #1a3a5c", paddingTop: 8, marginTop: 4 }}>
                    {selected.description}
                  </div>
                )}
              </div>
            </div>
          )}
        </div>
      </div>
    </div>
  );
}