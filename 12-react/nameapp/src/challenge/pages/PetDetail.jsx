import { useEffect, useState } from 'react'
import { useNavigate, useParams } from 'react-router-dom'
import {
  MagnifyingGlass,
  PawPrint,
  Dog,
  Calendar,
  TennisBall,
  MapPin,
  ArrowLeft,
} from '@phosphor-icons/react'
import { getPet } from '../api/pets'
import { CHALLENGE_BASE } from '../constants'
import '../styles/detail.css'

const kindLabels = {
  perro: 'Perro',
  gato: 'Gato',
  conejo: 'Conejo',
  ave: 'Ave',
  otros: 'Otros',
}

export default function PetDetail() {
  const { id } = useParams()
  const navigate = useNavigate()
  const [pet, setPet] = useState(null)
  const [loading, setLoading] = useState(true)

  useEffect(() => {
    getPet(id)
      .then(({ data }) => setPet(data.pet))
      .catch(() => navigate(CHALLENGE_BASE))
      .finally(() => setLoading(false))
  }, [id, navigate])

  const placeholderImg =
    'https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?w=400&h=400&fit=crop'

  if (loading) {
    return <div className="detail-page detail-loading">Cargando...</div>
  }

  if (!pet) return null

  const rows = [
    { icon: PawPrint, label: 'Nombre', value: pet.name },
    { icon: Dog, label: 'Tipo', value: kindLabels[pet.kind] || pet.kind },
    { icon: Calendar, label: 'Peso', value: pet.weight ? `${pet.weight} kg` : '—' },
    { icon: TennisBall, label: 'Raza', value: pet.breed || '—' },
    { icon: MapPin, label: 'Ubicación', value: pet.location || '—' },
  ]

  return (
    <div className="detail-page">
      <div
        className="detail-bg-top"
        style={{
          backgroundImage:
            'url(https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=600&h=800&fit=crop)',
        }}
      />

      <header className="detail-header">
        <MagnifyingGlass size={20} weight="bold" />
        <span>Pet Profile Hub</span>
      </header>

      <div className="detail-photo-wrap">
        <img
          src={pet.image || placeholderImg}
          alt={pet.name}
          className="detail-photo"
        />
      </div>

      <div className="detail-card">
        {rows.map(({ icon: Icon, label, value }) => (
          <div key={label} className="detail-row">
            <div className="detail-row-left">
              <Icon size={20} weight="fill" className="detail-row-icon" />
              <span className="detail-row-label">{label}</span>
            </div>
            <span className="detail-row-value">{value}</span>
          </div>
        ))}
      </div>

      <div className="detail-actions">
        <button type="button" className="detail-btn-back" onClick={() => navigate(CHALLENGE_BASE)}>
          <ArrowLeft size={18} weight="bold" />
          Volver
        </button>
        <button
          type="button"
          className="detail-btn-edit"
          onClick={() => navigate(`${CHALLENGE_BASE}/pets/${id}/edit`)}
        >
          Editar
        </button>
      </div>
    </div>
  )
}