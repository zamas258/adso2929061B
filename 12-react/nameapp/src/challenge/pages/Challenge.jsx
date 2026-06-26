import { Routes, Route, Navigate } from 'react-router-dom'
import { AuthProvider, useAuth } from '../challenge/context/AuthContext'
import ProtectedRoute from '../challenge/components/ProtectedRoute'
import Login from '../challenge/pages/Login'
import Dashboard from '../challenge/pages/Dashboard'
import PetDetail from '../challenge/pages/PetDetail'
import PetForm from '../challenge/pages/PetForm'
import { CHALLENGE_BASE } from '../challenge/constants'
import '../challenge/styles/challenge.css'

function GuestRoute({ children }) {
  const { isAuthenticated } = useAuth()
  if (isAuthenticated) return <Navigate to={CHALLENGE_BASE} replace />
  return children
}

function ChallengeRoutes() {
  return (
    <div className="challenge-app">
      <Routes>
        <Route
          path="login"
          element={
            <GuestRoute>
              <Login />
            </GuestRoute>
          }
        />
        <Route
          index
          element={
            <ProtectedRoute>
              <Dashboard />
            </ProtectedRoute>
          }
        />
        <Route
          path="pets/new"
          element={
            <ProtectedRoute>
              <PetForm />
            </ProtectedRoute>
          }
        />
        <Route
          path="pets/:id/edit"
          element={
            <ProtectedRoute>
              <PetForm />
            </ProtectedRoute>
          }
        />
        <Route
          path="pets/:id"
          element={
            <ProtectedRoute>
              <PetDetail />
            </ProtectedRoute>
          }
        />
        <Route path="*" element={<Navigate to={CHALLENGE_BASE} replace />} />
      </Routes>
    </div>
  )
}

function Challenge() {
  return (
    <div className="challenge-wrapper">
      <AuthProvider>
        <ChallengeRoutes />
      </AuthProvider>
    </div>
  )
}

export default Challenge