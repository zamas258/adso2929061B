import { Navigate } from 'react-router-dom'
import { useAuth } from '../context/AuthContext'
import { CHALLENGE_BASE } from '../constants'

export default function ProtectedRoute({ children }) {
  const { isAuthenticated } = useAuth()

  if (!isAuthenticated) {
    return <Navigate to={`${CHALLENGE_BASE}/login`} replace />
  }

  return children
}