import { useEffect, useState } from 'react'
import { useNavigate } from 'react-router-dom'
import {
  SquaresFour,
  Gear,
  PawPrint,
  MagnifyingGlass,
  PencilSimple,
  Trash,
  CaretLeft,
  CaretRight,
  Plus,
  SignOut,
} from '@phosphor-icons/react'
import { getPets, deletePet } from '../api/pets'
import { useAuth } from '../context/AuthContext'
import { CHALLENGE_BASE } from '../constants'
import '../styles/dashboard.css'

const PER_PAGE = 4

export default function Dashboard() {
  const [pets, setPets] = useState([])
  const [search, setSearch] = useState('')
  const [page, setPage] = useState(0)
  const [loading, setLoading] = useState(true)
  const navigate = useNavigate()
  const { logout } = useAuth()

  const loadPets = async () => {
    setLoading(true)
    try {
      const { data } = await getPets()
      setPets(data.pets || [])
    } catch {
      setPets([])
    } finally {
      setLoading(false)
    }
  }

  useEffect(() => {
    loadPets()
  }, [])

  const filtered = pets.filter((pet) =>
    pet.name.toLowerCase().includes(search.toLowerCase())
  )

  const totalPages = Math.max(1, Math.ceil(filtered.length / PER_PAGE))
  const currentPage = Math.min(page, totalPages - 1)
  const visible = filtered.slice(
    currentPage * PER_PAGE,
    currentPage * PER_PAGE + PER_PAGE
  )

  const handleDelete = async (id, name) => {
    if (!window.confirm(`¿Eliminar a ${name}?`)) return
    try {
      await deletePet(id)
      await loadPets()
    } catch {
      alert('No se pudo eliminar la mascota')
    }
  }

  const handleLogout = async () => {
    await logout()
    navigate(`${CHALLENGE_BASE}/login`)
  }

  const handleSettings = () => {
    alert('Pantalla de configuración (en desarrollo)')
  }

  const placeholderImg =
    'https://images.unsplash.com/photo-1587300003388-59208cc962cb?w=400&h=400&fit=crop'

  return (
    <div className="dashboard-page">
      <div
        className="dashboard-bg"
        style={{
          backgroundImage:
            'url(https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=600&h=800&fit=crop)',
        }}
      />

      <header className="dash-header">
        <div className="dash-header-left">
          <SquaresFour size={22} weight="bold" />
          <span>Dashboard</span>
        </div>
        <div style={{ display: 'flex', gap: '0.75rem', alignItems: 'center' }}>
          <button
            type="button"
            className="dash-icon-btn"
            onClick={handleSettings}
            title="Configuración"
          >
            <Gear size={22} weight="regular" />
          </button>
          <button
            type="button"
            className="dash-icon-btn"
            onClick={handleLogout}
            title="Cerrar sesión"
          >
            <SignOut size={22} weight="regular" />
          </button>
        </div>
      </header>

      <main className="dash-main">
        <div className="dash-title">
          <PawPrint size={22} weight="fill" />
          <h1>Lista de mascotas</h1>
        </div>

        <div className="dash-search">
          <MagnifyingGlass size={20} weight="bold" />
          <input
            type="text"
            placeholder="Search"
            value={search}
            onChange={(e) => {
              setSearch(e.target.value)
              setPage(0)
            }}
          />
        </div>

        {loading ? (
          <p className="dash-status">Cargando mascotas...</p>
        ) : (
          <div className="dash-grid">
            {visible.map((pet) => (
              <article key={pet.id} className="pet-card">
                <div className="pet-card-body">
                  <div className="pet-card-left">
                    <img
                      src={pet.image || placeholderImg}
                      alt={pet.name}
                      className="pet-card-img"
                    />
                    <p className="pet-card-name">{pet.name}</p>
                  </div>
                  <div className="pet-card-right">
                    <p className="pet-card-desc">
                      {pet.description || 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'}
                    </p>
                  </div>
                </div>
                <div className="pet-card-actions">
                  <button
                    type="button"
                    onClick={() => navigate(`${CHALLENGE_BASE}/pets/${pet.id}`)}
                    title="Ver"
                  >
                    <MagnifyingGlass size={18} weight="bold" />
                  </button>
                  <span className="action-divider">|</span>
                  <button
                    type="button"
                    onClick={() => navigate(`${CHALLENGE_BASE}/pets/${pet.id}/edit`)}
                    title="Editar"
                  >
                    <PencilSimple size={18} weight="bold" />
                  </button>
                  <span className="action-divider">|</span>
                  <button
                    type="button"
                    onClick={() => handleDelete(pet.id, pet.name)}
                    title="Eliminar"
                  >
                    <Trash size={18} weight="bold" />
                  </button>
                </div>
              </article>
            ))}
          </div>
        )}

        <div className="dash-footer">
          <div className="dash-pagination">
            <button
              type="button"
              disabled={currentPage === 0}
              onClick={() => setPage((p) => p - 1)}
              className="pagination-btn"
            >
              <CaretLeft size={20} weight="bold" />
            </button>
            <button
              type="button"
              disabled={currentPage >= totalPages - 1}
              onClick={() => setPage((p) => p + 1)}
              className="pagination-btn"
            >
              <CaretRight size={20} weight="bold" />
            </button>
          </div>

          <button
            type="button"
            className="dash-add-btn"
            onClick={() => navigate(`${CHALLENGE_BASE}/pets/new`)}
          >
            <span>Añadir mascota</span>
            <span className="add-btn-icon-wrap">
              <Plus size={18} weight="bold" />
            </span>
          </button>
        </div>
      </main>
    </div>
  )
}