import BtnBack from '../components/BtnBack';

const imagenMeme = 'https://i.pinimg.com/originals/b0/3b/e4/b03be4646ccba277abf4416eefb39532.jpg'

function Example2JSX() {
    return(
        <div className="container">
            <BtnBack />
            
            <h2>Example2JSX</h2>
            <p>Writing HTML-Like code whitin JavaScript using curly brace  &#123; &#125;  for JS expresions.</p>
            {}
            <img 
                src={imagenMeme} 
                alt="meme" 
                style={{ width: '500px', display: 'block', margin: '20px auto' }} 
            />
            
            {}
            <p style={{ fontSize: '25px', textAlign: 'center' }}>
                <strong>Yo:</strong> "{4+5}" es igual a {4+5}
            </p>
            
            <p style={{ fontSize: '20px', textAlign: 'center' }}>
                React:  Correcto!
            </p>
            
            <p style={{ fontSize: '18px', textAlign: 'center' }}>
                Yo: {10 > 5 ? " Ya sé React" : " No entendí nada"}
            </p>
            
            <button onClick={() => alert("JSX es fácil!")}>
                 Entendido
            </button>
        </div>
    );
}

export default Example2JSX;