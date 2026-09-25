// Re-encode an image in the browser before upload: strips metadata (EXIF, etc.),
// normalizes the filename and shrinks large files. This avoids the hosting WAF
// (ModSecurity) rejecting uploads with a 403.
export async function sanitizeImage(file, name = 'image', { maxWidth = 1920, quality = 0.85 } = {}) {
  try {
    const bitmap = await createImageBitmap(file)
    const scale = Math.min(1, maxWidth / bitmap.width)
    const canvas = document.createElement('canvas')
    canvas.width = Math.round(bitmap.width * scale)
    canvas.height = Math.round(bitmap.height * scale)
    canvas.getContext('2d').drawImage(bitmap, 0, 0, canvas.width, canvas.height)
    bitmap.close?.()

    const blob = await new Promise((resolve) => canvas.toBlob(resolve, 'image/webp', quality))
    if (!blob) throw new Error('encode failed')

    // Browsers without WebP encoding fall back to PNG
    const ext = blob.type === 'image/webp' ? 'webp' : 'png'
    return new File([blob], `${name}.${ext}`, { type: blob.type })
  } catch {
    const ext = (file.name.split('.').pop() || 'jpg').toLowerCase().replace(/[^a-z0-9]/g, '')
    return new File([file], `${name}.${ext}`, { type: file.type })
  }
}
