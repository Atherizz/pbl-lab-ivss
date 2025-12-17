CREATE TABLE users (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL DEFAULT 'mahasiswa' 
        CHECK (role IN ('admin_lab', 'admin_berita', 'mahasiswa')),
    account_status VARCHAR(50) NOT NULL DEFAULT 'active' 
        CHECK (account_status IN ('active', 'graduated', 'inactive')),
    supervisor_id BIGINT NULL REFERENCES users(id) ON DELETE SET NULL
);

CREATE INDEX idx_users_email ON users(email);
CREATE INDEX idx_users_role ON users(role);

CREATE TABLE user_profiles (
    user_id BIGINT PRIMARY KEY,
    profile_image_url TEXT NULL,
    research_focus TEXT NULL,
    CONSTRAINT fk_user
        FOREIGN KEY(user_id) 
        REFERENCES users(id)
        ON DELETE CASCADE
);

CREATE TABLE equipment (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'available'
        CHECK (status IN ('available', 'in_use', 'maintenance', 'broken'))
);

CREATE TABLE equipment_bookings (
    id BIGSERIAL PRIMARY KEY,
    equipment_id BIGINT NOT NULL REFERENCES equipment(id) ON DELETE CASCADE,
    user_id BIGINT NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    start_date TIMESTAMPTZ NOT NULL,
    end_date TIMESTAMPTZ NOT NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'pending_approval'
        CHECK (status IN ('pending_approval', 'approved', 'rejected', 'returned')),
    notes TEXT NULL
);

CREATE INDEX idx_equipment_status ON equipment(status);

CREATE TABLE research_projects (
    id BIGSERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    start_date DATE NULL,
    end_date DATE NULL,
    publication_url TEXT NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'pending_approval'
        CHECK (status IN ('pending_approval', 'pending_approval', 'active', 'completed', 'rejected')),
    primary_investigator_id BIGINT NULL REFERENCES users(id) ON DELETE SET NULL
);


CREATE TABLE news (
    id BIGSERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    image_url TEXT NULL,
    author_id BIGINT NOT NULL REFERENCES users(id) ON DELETE SET NULL,
    published_at TIMESTAMPTZ NULL
);



-- MIGRATION 2

-- BUAT TABLE DATASETS
CREATE TABLE datasets (
  id BIGSERIAL PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description TEXT NULL,           
  urls JSONB NOT NULL DEFAULT '[]',   
  file_url TEXT NOT NULL, 
  tags TEXT[] NULL -- Tag sederhana, mis: {'vision','YOLO','dataset-wajah'}
);

-- HAPUS ISI TABLE PENELITIAN TERLEBIH DAHULU
truncate research_projects cascade;


-- UBAH STRUKUTR TABLE PENELITIAN
ALTER TABLE research_projects
RENAME COLUMN primary_investigator_id TO user_id;

ALTER TABLE research_projects
ADD COLUMN dospem_id BIGINT NULL REFERENCES users(id) ON DELETE SET NULL;

ALTER TABLE research_projects
DROP CONSTRAINT research_projects_status_check;

ALTER TABLE research_projects
ALTER COLUMN status SET DEFAULT 'pending_approval',
ADD CONSTRAINT research_projects_status_check
    CHECK (status IN ('pending_approval', 'approved_by_dospem', 'approved_by_head', 'completed', 'rejected'));

-- HAPUS DULU USER DENGAN ROLE MAHASISWA
delete from users where email = 'savero@gmail.com';


-- UBAH ROLE USER
ALTER TABLE users
DROP CONSTRAINT users_role_check;

ALTER TABLE users
ADD CONSTRAINT users_role_check
  CHECK (role IN ('admin_lab', 'admin_berita', 'anggota_lab'));

-- BUAT USER LAGI
INSERT INTO users (name, email, password, role, account_status) 
VALUES (
    'Savero', 
    'savero@gmail.com', 
    '$2y$10$QO/LnId/OIRXosK2QpJkfeiRVrx5JKM3fLojypGQg6n2W0s3hl0HO', 
    'anggota_lab', 
    'active'
);


-- MIGRATION 3

-- UBAH ROLE USER
ALTER TABLE users
DROP CONSTRAINT users_role_check;

ALTER TABLE users
ADD CONSTRAINT users_role_check
  CHECK (role IN ('admin_lab', 'admin_berita', 'anggota_lab', 'mahasiswa'));

INSERT INTO users (name, email, password, role, account_status) 
VALUES (
    'mahasiswa', 
    'mahasiswa@gmail.com', 
    '$2y$10$QO/LnId/OIRXosK2QpJkfeiRVrx5JKM3fLojypGQg6n2W0s3hl0HO', 
    'mahasiswa', 
    'active'
);

-- MIGRATION 4

CREATE TABLE registration_requests (
    id BIGSERIAL PRIMARY KEY,
    nim VARCHAR(20) NOT null,
    name VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL, 
    registration_purpose TEXT,
    dospem_id BIGINT NULL REFERENCES users(id) ON DELETE SET NULL, 
    status VARCHAR(50) NOT NULL DEFAULT 'pending_approval'
        CHECK (status IN ('pending_approval', 'approved_by_dospem', 'approved_by_head')),
    rejection_reason TEXT NULL 
);

truncate users cascade;

ALTER TABLE users
    DROP COLUMN email,
    DROP COLUMN supervisor_id;

-- 2️⃣ Tambah kolom baru sesuai struktur baru
ALTER TABLE users
    ADD COLUMN reg_number VARCHAR(20),
    ADD COLUMN dospem_id BIGINT NULL;
    ADD COLUMN profile_image_url TEXT,
    ADD COLUMN research_focus TEXT;

-- 3️⃣ Tambah foreign key self-reference ke dospem_id
ALTER TABLE users
    ADD CONSTRAINT fk_users_dospem
    FOREIGN KEY (dospem_id) REFERENCES users(id) ON DELETE SET NULL;

-- 4️⃣ Buat ulang index untuk validasi dan performa
CREATE UNIQUE INDEX uq_users_reg_number ON users(reg_number);
CREATE INDEX idx_users_role ON users(role);


-- Dummy data untuk setiap role (PostgreSQL)
INSERT INTO users (name, reg_number, password, role, account_status)
VALUES
-- 👨‍🔧 Admin Lab (NIP)
('Rizky Adi Pratama', '140001', '$2y$10$QO/LnId/OIRXosK2QpJkfeiRVrx5JKM3fLojypGQg6n2W0s3hl0HO', 'admin_lab', 'active'),

-- 📰 Admin Berita (NIP)
('Siti Lestari', '140002', '$2y$10$QO/LnId/OIRXosK2QpJkfeiRVrx5JKM3fLojypGQg6n2W0s3hl0HO', 'admin_berita', 'active'),

-- 👥 Anggota Lab (NIP)
('Budi Santoso', '140003', '$2y$10$QO/LnId/OIRXosK2QpJkfeiRVrx5JKM3fLojypGQg6n2W0s3hl0HO', 'anggota_lab', 'active'),

-- 🎓 Mahasiswa (NIM)
('Savero Athallah', '2441720001', '$2y$10$QO/LnId/OIRXosK2QpJkfeiRVrx5JKM3fLojypGQg6n2W0s3hl0HO', 'mahasiswa', 'active');

-- MIGRATION 5

CREATE TYPE major_enum AS ENUM (
  'Teknik Informatika',
  'Sistem Informasi Bisnis',
  'Pengembangan Piranti Lunak Situs',
  'Rekayasa Teknologi Informasi'
);

CREATE TABLE lab_user_profiles (
  user_id            BIGINT PRIMARY KEY REFERENCES users(id) ON DELETE CASCADE,

  nip                VARCHAR(30) UNIQUE,
  nidn               VARCHAR(30) UNIQUE,
  major              major_enum,       
  email              VARCHAR(255),
  photo_url          TEXT,

  -- object: { "linkedin": "...", "google_scholar": "...", "sinta": "...", "cv": "...", "website": "...", ... }
  social_links       JSONB NOT NULL DEFAULT '{}'::jsonb,

  -- array of strings: ["Data Science","Machine Learning","IR"]
  research_focus     JSONB NOT NULL DEFAULT '[]'::jsonb,

  -- array of objects:
  -- [ { "level":"S2", "degree":"Teknik Informatika", "institution":"ITS", "start_year":2014, "end_year":2016 },
  --   { "level":"S1", "degree":"Ilmu Komputer", "institution":"UB",  "start_year":2009, "end_year":2014 } ]
  educations         JSONB NOT NULL DEFAULT '[]'::jsonb,

  -- array of objects:
  -- [ { "name":"IT Specialist - AI", "issuer":"Pearson VUE", "issued_on":"2025-02-01", "expires_on":null, "credential_url":"..." }, ... ]
  certifications     JSONB NOT NULL DEFAULT '[]'::jsonb,

  -- sanity checks tipe JSON
  CONSTRAINT chk_social_object       CHECK (jsonb_typeof(social_links)   = 'object'),
  CONSTRAINT chk_focus_array         CHECK (jsonb_typeof(research_focus) = 'array'),
  CONSTRAINT chk_edu_array           CHECK (jsonb_typeof(educations)     = 'array'),
  CONSTRAINT chk_cert_array          CHECK (jsonb_typeof(certifications) = 'array')
);

ALTER TABLE equipment_bookings
ADD COLUMN return_proof_url TEXT NULL;

ALTER TABLE registration_requests
DROP CONSTRAINT registration_requests_status_check;

ALTER TABLE registration_requests
ADD CONSTRAINT registration_requests_status_check
    CHECK (status IN (
        'pending_approval',
        'approved_by_dospem',
        'approved_by_head',
        'rejected'
    ));


ALTER TABLE research_projects
ADD COLUMN rejection_reason TEXT NULL;

-- migration 6
ALTER TABLE registration_requests
    ALTER COLUMN password DROP NOT NULL;

ALTER TABLE users
    ALTER COLUMN password DROP NOT NULL;

ALTER TABLE users
    DROP COLUMN profile_image_url;

ALTER TABLE users
    DROP COLUMN research_focus;

-- migration 7
-- CEK DULU NAMA CONSTRAINTNYA, LALU SESUAIKAN 
SELECT constraint_name 
FROM information_schema.table_constraints 
WHERE table_name = 'research_projects' 
AND constraint_type = 'FOREIGN KEY';

-- Untuk tabel news
ALTER TABLE news 
DROP CONSTRAINT news_author_id_fkey;  -- nama default biasanya: tablename_columnname_fkey

ALTER TABLE news 
ADD CONSTRAINT fk_news_author 
    FOREIGN KEY (author_id) 
    REFERENCES users(id) 
    ON DELETE CASCADE;

-- Untuk tabel research_projects
ALTER TABLE research_projects 
DROP CONSTRAINT research_projects_primary_investigator_id_fkey;

ALTER TABLE research_projects 
ADD CONSTRAINT research_projects_primary_investigator_id_fkey 
    FOREIGN KEY (user_id) 
    REFERENCES users(id) 
    ON DELETE CASCADE;

ALTER TABLE research_projects 
DROP CONSTRAINT research_projects_dospem_id_fkey;

ALTER TABLE research_projects 
ADD CONSTRAINT research_projects_dospem_id_fkey
    FOREIGN KEY (dospem_id) 
    REFERENCES users(id) 
    ON DELETE CASCADE;



-- MIGRATION 7
truncate news, lab_user_profiles;

ALTER TABLE news 
ADD COLUMN slug VARCHAR(255) UNIQUE NOT NULL;
CREATE INDEX idx_news_slug ON news(slug);

ALTER TABLE lab_user_profiles 
ADD COLUMN slug VARCHAR(255) UNIQUE NOT NULL;

-- Insert lab_user_profiles dengan slug dari nama user
INSERT INTO lab_user_profiles (user_id, slug)
SELECT 
    u.id,
    LOWER(REGEXP_REPLACE(REGEXP_REPLACE(u.name, '[^a-zA-Z0-9\s-]', '', 'g'), '\s+', '-', 'g')) as slug
FROM users u
WHERE u.reg_number IN ('140001', '140002', '140003', '2441720001');

CREATE TABLE publications (
    id BIGSERIAL PRIMARY KEY,
    user_id BIGINT NOT NULL,
    
    -- Data dari Scholar
    title VARCHAR(500) NOT NULL,
    authors TEXT NOT NULL,
    publication_venue TEXT NULL,  -- "Genome biology 9 (9), 1-9, 2008"
    year INTEGER NULL,
    
    -- Scholar identifiers
    citation_id VARCHAR(100) UNIQUE NULL,  
    scholar_link TEXT NULL,
    
    -- Citation metrics
    cited_by_count INTEGER DEFAULT 0,
    cited_by_link TEXT NULL,

    CONSTRAINT fk_publications_user
        FOREIGN KEY (user_id) 
        REFERENCES users(id) 
        ON DELETE CASCADE
);


CREATE TABLE products (
    id BIGSERIAL PRIMARY KEY,
    
    judul VARCHAR(255) NOT NULL,
    deskripsi TEXT NOT NULL,
    produk_url TEXT NULL,
    image_url TEXT NULL,
    
    -- Menggantikan 'tags'
    -- array of strings: ["IoT", "Monitoring", "Perikanan"]
    produk_type JSONB NOT NULL DEFAULT '[]'::jsonb, 

    -- array of objects (hanya judul):
    -- [ { "judul":"Real-time Monitoring" }, 
    --   { "judul":"Notifikasi Kualitas Air" } ]
    features JSONB NOT NULL DEFAULT '[]'::jsonb, 

    -- Sanity checks untuk tipe JSON
    CONSTRAINT chk_produk_type_array    CHECK (jsonb_typeof(produk_type) = 'array'), -- Constraint yang diperbarui
    CONSTRAINT chk_features_array       CHECK (jsonb_typeof(features) = 'array')
);
-- -- migration baru course di atmin :
-- query dari menu edukasi 

CREATE TABLE courses (
    id SERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    icon_name VARCHAR(100), 
    level VARCHAR(50),      
    total_sessions INTEGER,     
    action_url VARCHAR(255), 
    created_at TIMESTAMP WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS galeries (
    id SERIAL PRIMARY KEY,
    author_id INTEGER NULL,
    caption TEXT NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL,

    -- Constraint Unique untuk Slug
    CONSTRAINT galeries_slug_unique UNIQUE (slug),

    -- Foreign Key ke tabel users
    CONSTRAINT fk_galery_author 
        FOREIGN KEY (author_id) 
        REFERENCES users(id) 
        ON DELETE SET NULL 
        ON UPDATE CASCADE
);
-- MIGRATION 8 
truncate registration_requests;

ALTER TABLE registration_requests 
ADD COLUMN email VARCHAR(255) NOT NULL UNIQUE;


-- MIGRATION 9
ALTER TABLE registration_requests DROP CONSTRAINT registration_requests_email_key;

ALTER TABLE equipment ADD COLUMN category VARCHAR(15) NOT NULL DEFAULT 'equipment' CHECK (category IN ('equipment', 'facility'));

CREATE OR REPLACE FUNCTION fn_sync_equipment_status()
RETURNS TRIGGER AS $$
BEGIN
    -- 1. Saat Booking disetujui (Approved) -> Alat jadi In Use
    IF (NEW.status = 'approved' AND (OLD.status IS NULL OR OLD.status != 'approved')) THEN
        UPDATE equipment 
        SET status = 'in_use' 
        WHERE id = NEW.equipment_id;

    -- 2. Saat Barang dikembalikan (Returned) -> Alat jadi Available kembali
    ELSIF (NEW.status = 'returned' AND (OLD.status IS NULL OR OLD.status != 'returned')) THEN
        UPDATE equipment 
        SET status = 'available' 
        WHERE id = NEW.equipment_id;

    -- 3. Jika Booking dibatalkan/ditolak setelah sempat approved (Opsional)
    ELSIF (NEW.status IN ('rejected') AND OLD.status = 'approved') THEN
        UPDATE equipment 
        SET status = 'available' 
        WHERE id = NEW.equipment_id;
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

-- Pasang Trigger ke tabel bookings
CREATE TRIGGER trg_sync_equipment_status
AFTER UPDATE ON equipment_bookings
FOR EACH ROW
EXECUTE FUNCTION fn_sync_equipment_status();

