# Dokumentasi API Nimirikid

## Basis URL
API ini dapat diakses di `http://127.0.0.1:8000/api/`.

---

## Endpoint: Pelanggan

### 1. GET /api/pelanggan
Deskripsi: Mengambil semua data pelanggan.

**Response Example:**

```json
{
    "id_pelanggan": 1,
    "user_id": 10,
    "nama_pelanggan": "John Doe",
    "alamat": "Jl. Merdeka No. 10",
    "email": "john@example.com",
    "no_hp": "081234567890"
}
```

### 2. POST /api/pelanggan
Deskripsi: Menambahkan pelanggan baru.

**Request Body:**

```json
{
    "nama_pelanggan": "John Doe",
    "alamat": "Jl. Merdeka No. 10",
    "email": "john@example.com",
    "no_hp": "081234567890"
}
```

**Response Example:**

```json
{
    "id_pelanggan": 2,
    "user_id": 11,
    "nama_pelanggan": "John Doe",
    "alamat": "Jl. Merdeka No. 10",
    "email": "john@example.com",
    "no_hp": "081234567890"
}
```

### 3. GET /api/pelanggan/{id}
Deskripsi: Menampilkan data pelanggan berdasarkan ID.

**Response Example:**

```json
{
    "id_pelanggan": 1,
    "user_id": 10,
    "nama_pelanggan": "John Doe",
    "alamat": "Jl. Merdeka No. 10",
    "email": "john@example.com",
    "no_hp": "081234567890"
}
```

## Endpoint: Kurir

### 1. GET /api/kurir
Deskripsi: Mengambil semua data kurir.

**Response Example:**

```json
{
    "id_kurir": 1,
    "user_id": 12,
    "nama_kurir": "Jane Smith",
    "no_hp": "081234567891",
    "area_pengiriman": "Jakarta",
    "status": "Aktif"
}
```

### 2. GET /api/kurir/{id}
Deskripsi: Menampilkan data kurir berdasarkan ID.

**Response Example:**

```json
{
    "id_kurir": 1,
    "user_id": 12,
    "nama_kurir": "Jane Smith",
    "no_hp": "081234567891",
    "area_pengiriman": "Jakarta",
    "status": "Aktif"
}
```

### 3. GET /api/kurir/{id}/paket
Deskripsi: Menampilkan semua paket yang ditangani oleh kurir tertentu.

**Response Example:**

```json
{
    "id_paket": 1,
    "id_pengirim": 1,
    "id_penerima": 2,
    "id_kurir": 1,
    "status": "Pending",
    "tanggal_pengiriman": "2023-11-01"
}
```

## Endpoint: Paket

### 1. GET /api/paket
Deskripsi: Mengambil semua paket.

**Response Example:**

```json
{
    "id_paket": 1,
    "id_pengirim": 1,
    "id_penerima": 2,
    "id_kurir": 1,
    "status": "Pending",
    "tanggal_pengiriman": "2023-11-01"
}
```

### 2. POST /api/paket
Deskripsi: Menambahkan paket baru.

**Request Body:**

```json
{
    "id_pengirim": 1,
    "id_penerima": 2,
    "id_kurir": 1,
    "status": "Pending",
    "tanggal_pengiriman": "2023-11-01"
}
```

**Response Example:**

```json
{
    "id_paket": 2,
    "id_pengirim": 1,
    "id_penerima": 2,
    "id_kurir": 1,
    "status": "Pending",
    "tanggal_pengiriman": "2023-11-02"
}
```

### 3. PUT /api/paket/{id}
Deskripsi: Mengubah data paket berdasarkan ID.

**Request Body:**

```json
{
    "status": "Dalam Pengiriman"
}
```

**Response Example:**

```json
{
    "id_paket": 1,
    "status": "Dalam Pengiriman",
    "tanggal_pengiriman": "2023-11-01"
}
```

## Endpoint: Status Pengiriman

### 1. GET /api/status-pengiriman
Deskripsi: Mengambil semua status pengiriman.

**Response Example:**

```json
{
    "id_status": 1,
    "id_paket": 1,
    "status": "Pending",
    "waktu_status": "2023-11-01T10:00:00",
    "catatan": "Paket baru dibuat dan menunggu proses pengambilan oleh kurir"
}
```

### 2. POST /api/status-pengiriman
Deskripsi: Menambahkan status pengiriman baru.

**Request Body:**

```json
{
    "id_paket": 1,
    "status": "Diambil",
    "waktu_status": "2023-11-02T08:00:00",
    "catatan": "Paket sudah diambil oleh kurir"
}
```

**Response Example:**

```json
{
    "id_status": 2,
    "id_paket": 1,
    "status": "Diambil",
    "waktu_status": "2023-11-02T08:00:00",
    "catatan": "Paket sudah diambil oleh kurir"
}
```

## Autentikasi dan Keamanan
API ini tidak dilengkapi dengan autentikasi berbasis token di dokumentasi ini. Namun, untuk keamanan, API ini dapat dilengkapi dengan autentikasi Sanctum atau Passport agar dapat digunakan secara aman di frontend.

## Catatan:
- Data pada API ini dikembalikan dalam format JSON.
- Semua metode HTTP seperti GET, POST, PUT, dan DELETE digunakan sesuai dengan prinsip RESTful.
- Pastikan bahwa semua data yang dikirimkan sudah tervalidasi di backend sebelum disimpan.
