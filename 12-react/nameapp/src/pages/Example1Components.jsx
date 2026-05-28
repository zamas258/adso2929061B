import BtnBack from '../components/BtnBack';

function Goku() {
    return(
        <div style={{
            border: '2px solid #f39c12',
            borderRadius: '12px',
            padding: '1rem',
            backgroundColor: '#e74c3c',
            color: 'white',
            textAlign: 'center',
            width: '180px'
        }}>
            <h5>⚡ Name: Kakaroto</h5>
            <h5>🔥 Type: Saiyan</h5>
            <h5>💥 Attack: Kamehameha</h5>
        </div>
    );
}

function Vegeta() {
    return(
        <div style={{
            border: '2px solid #f39c12',
            borderRadius: '12px',
            padding: '1rem',
            backgroundColor: '#2c3e50',
            color: 'white',
            textAlign: 'center',
            width: '180px'
        }}>
            <h5>👑 Name: Vegeta</h5>
            <h5>🔥 Type: Saiyan</h5>
            <h5>💥 Attack: Galick Gun</h5>
        </div>
    );
}

function Gohan() {
    return(
        <div style={{
            border: '2px solid #f39c12',
            borderRadius: '12px',
            padding: '1rem',
            backgroundColor: '#27ae60',
            color: 'white',
            textAlign: 'center',
            width: '180px'
        }}>
            <h5>📚 Name: Gohan</h5>
            <h5>🔥 Type: Saiyan</h5>
            <h5>💥 Attack: Masenko</h5>
        </div>
    );
}

function Example1Components() {
    return(
        <div className="container">
            <BtnBack />
            <h2 style={{ color: '#e74c3c', marginBottom: '10px' }}>Example1Components</h2>
            <p style={{ fontSize: '16px', color: '#555' }}>Create independent and reusable UI pieces.</p>
            <div style={{
                display: 'flex',
                justifyContent: 'center',
                marginTop: '1.4rem',
                gap: '1.5rem',
                flexWrap: 'wrap'
            }}>
                <Goku />
                <Vegeta />
                <Gohan />
            </div>
        </div>
    );
}

export default Example1Components;