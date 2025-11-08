CREATE TABLE users (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL DEFAULT 'mahasiswa' 
        CHECK (role IN ('admin_lab', 'admin_berita', 'mahasiswa')),
    account_status VARCHAR(50) NOT NULL DEFAULT 'active' 
        CHECK (account_status IN ('active', 'graduated', 'inactive')),
    supervisor_id BIGINT NULL REFERENCES users(id) ON DELETE SET NULL, 
);

CREATE INDEX idx_users_email ON users(email);
CREATE INDEX idx_users_role ON users(role);

CREATE TABLE user_profiles (
    user_id BIGINT PRIMARY KEY,
    profile_image_url TEXT NULL,
    research_focus TEXT NULL,
    bio TEXT NULL,
    phone_number VARCHAR(50) NULL,
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

CREATE TABLE registration_requests (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE, 
    password VARCHAR(255) NOT NULL, 
    supervisor_id BIGINT NULL REFERENCES users(id) ON DELETE SET NULL, 
    approval_letter_url TEXT NULL, 
    status VARCHAR(50) NOT NULL DEFAULT 'pending_admin_approval'
        CHECK (status IN ('pending_admin_approval', 'rejected')),
    rejection_reason TEXT NULL 
);

-- MIGRATION 2

-- BUAT TABLE DATASETS
CREATE TABLE datasets (
  id BIGSERIAL PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description TEXT NULL,           
  urls JSONB NOT NULL DEFAULT '[]',   
  file_url TEXT NOT NULL, 
  tags TEXT[] NULL, -- Tag sederhana, mis: {'vision','YOLO','dataset-wajah'}
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

-- UBAH ROLE USER
ALTER TABLE users
DROP CONSTRAINT users_role_check;

ALTER TABLE users
ADD CONSTRAINT users_role_check
  CHECK (role IN ('admin_lab', 'admin_berita', 'anggota_lab'));

