import { useEffect, useState } from 'react'
import { useNavigate, useParams } from 'react-router-dom'
import { PencilSimple, Camera, ArrowLeft } from '@phosphor-icons/react'
import { getPet, createPet, updatePet } from '../api/pets'
import { CHALLENGE_BASE } from '../constants'
import '../styles/form.css'

const emptyForm = {
  name: '',
  kind: 'perro',
  weight: '',
  breed: '',
  location: '',
  image: '',
}

export default function PetForm() {
  const { id } = useParams()
  const isEdit = Boolean(id)
  const navigate = useNavigate()
  const [form, setForm] = useState(emptyForm)
  const [loading, setLoading] = useState(isEdit)
  const [saving, setSaving] = useState(false)
  const [error, setError] = useState('')

  useEffect(() => {
    if (!isEdit) return
    getPet(id)
      .then(({ data }) => {
        const pet = data.pet
        setForm({
          name: pet.name || '',
          kind: pet.kind || 'perro',
          weight: pet.weight ?? '',
          breed: pet.breed || '',
          location: pet.location || '',
          image: pet.image || '',
        })
      })
      .catch(() => navigate(CHALLENGE_BASE))
      .finally(() => setLoading(false))
  }, [id, isEdit, navigate])

  const handleChange = (e) => {
    const { name, value } = e.target
    setForm((prev) => ({ ...prev, [name]: value }))
  }

  const handleImageChange = (e) => {
    const file = e.target.files?.[0]
    if (!file) return
    const reader = new FileReader()
    reader.onload = () => setForm((prev) => ({ ...prev, image: reader.result }))
    reader.readAsDataURL(file)
  }

  const handleSubmit = async (e) => {
    e.preventDefault()
    setSaving(true)
    setError('')

    const payload = {
      name: form.name,
      kind: form.kind,
      weight: parseFloat(form.weight) || 0,
      age: 1,
      breed: form.breed,
      location: form.location,
      image: form.image || null,
      active: true,
      adopted: false,
    }

    try {
      if (isEdit) {
        await updatePet(id, payload)
        navigate(`${CHALLENGE_BASE}/pets/${id}`)
      } else {
        const { data } = await createPet(payload)
        navigate(`${CHALLENGE_BASE}/pets/${data.pet.id}`)
      }
    } catch (err) {
      const msg = err.response?.data?.message || 'Error al guardar'
      const errors = err.response?.data?.errors
      setError(errors ? Object.values(errors).flat().join(', ') : msg)
    } finally {
      setSaving(false)
    }
  }

  if (loading) {
    return <div className="form-page form-loading">Cargando...</div>
  }

  return (
    <div className="form-page">
      <div
        className="form-bg"
        style={{
          backgroundImage:
            'url(https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=600&h=800&fit=crop)',
        }}
      />

      <header className="form-header">
        <PencilSimple size={20} weight="bold" />
        <span>{isEdit ? 'Editar mascota' : 'Nueva mascota'}</span>
      </header>

      <main className="form-main">
        <label className="form-upload">
          <input type="file" accept="image/*" onChange={handleImageChange} hidden />
          {form.image ? (
            <img src={form.image} alt="Preview" className="form-upload-preview" />
          ) : (
            <>
              <Camera size={36} weight="fill" />
              <span>Cargar foto</span>
            </>
          )}
        </label>

        <form className="form-card" onSubmit={handleSubmit}>
          <h2>Informacion</h2>

          <label>
            Nombre
            <input name="name" value={form.name} onChange={handleChange} required />
          </label>

          <label>
            Tipo
            <select name="kind" value={form.kind} onChange={handleChange} required>
              <option value="perro">Perro</option>
              <option value="gato">Gato</option>
              <option value="conejo">Conejo</option>
              <option value="ave">Ave</option>
              <option value="otros">Otros</option>
            </select>
          </label>

          <label>
            Peso
            <input
              name="weight"
              type="number"
              step="0.01"
              min="0"
              value={form.weight}
              onChange={handleChange}
              required
            />
          </label>

          <label>
            Raza
            <input name="breed" value={form.breed} onChange={handleChange} />
          </label>

          <label>
            Ubicación
            <input name="location" value={form.location} onChange={handleChange} />
          </label>

          {error && <p className="form-error">{error}</p>}

          <div className="form-actions">
            <button type="button" className="form-btn-back" onClick={() => navigate(-1)}>
              <ArrowLeft size={18} weight="bold" />
              Volver
            </button>
            <button type="submit" className="form-btn-save" disabled={saving}>
              {saving ? 'Guardando...' : 'Guardar'}
            </button>
          </div>
        </form>
      </main>
    </div>
  )
}