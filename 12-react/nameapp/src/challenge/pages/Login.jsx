import { useState } from 'react'
import { useNavigate } from 'react-router-dom'
import { PawPrint, Lock } from '@phosphor-icons/react'
import { useAuth } from '../context/AuthContext'
import { CHALLENGE_BASE } from '../constants'
import bgLogin from '../assets/bg-login.png.jpg'
import '../styles/login.css'

export default function Login() {
  const [email, setEmail] = useState('')
  const [password, setPassword] = useState('')
  const [error, setError] = useState('')
  const { login, loading } = useAuth()
  const navigate = useNavigate()

  const handleSubmit = async (e) => {
    e.preventDefault()
    setError('')
    try {
      await login(email, password)
      navigate(CHALLENGE_BASE)
    } catch (err) {
      setError(err.response?.data?.message || 'Error al iniciar sesión')
    }
  }

  return (
    <div className="login-page" style={{ backgroundImage: `url(${bgLogin})` }}>
      <div className="login-overlay" />

      <div className="login-content">
        <div className="login-logo">
          <PawPrint size={64} weight="thin" />
        </div>

        <form className="login-form" onSubmit={handleSubmit}>
          <div className="login-field">
            <label htmlFor="challenge-email">Email</label>
            <input
              id="challenge-email"
              type="email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              required
              autoComplete="email"
              placeholder="tucorreo@ejemplo.com"
            />
          </div>

          <div className="login-field">
            <label htmlFor="challenge-password">Contraseña</label>
            <div className="login-password-wrap">
              <Lock size={20} weight="regular" className="login-lock-icon" />
              <input
                id="challenge-password"
                type="password"
                value={password}
                onChange={(e) => setPassword(e.target.value)}
                required
                autoComplete="current-password"
                placeholder="••••••••"
              />
            </div>
          </div>

          <button
            type="button"
            className="login-forgot"
            onClick={(e) => e.preventDefault()}
          >
            ¿Olvidaste?
          </button>

          {error && <p className="login-error">{error}</p>}

          <button type="submit" className="login-btn" disabled={loading}>
            {loading ? 'Cargando...' : 'Iniciar sesión'}
          </button>
        </form>
      </div>
    </div>
  )
}