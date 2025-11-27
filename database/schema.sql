-- ============================================
-- SCHEMA DATABASE - IVSS LAB MANAGEMENT
-- ============================================

-- TABLE: users
CREATE TABLE users (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    reg_number VARCHAR(20) UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL DEFAULT 'mahasiswa' 
        CHECK (role IN ('admin_lab', 'admin_berita', 'anggota_lab', 'mahasiswa')),
    account_status VARCHAR(50) NOT NULL DEFAULT 'active' 
        CHECK (account_status IN ('active', 'graduated', 'inactive')),
    dospem_id BIGINT NULL,
    profile_image_url TEXT NULL,
    research_focus TEXT NULL,
    CONSTRAINT fk_users_dospem
        FOREIGN KEY (dospem_id) 
        REFERENCES users(id) 
        ON DELETE SET NULL
);

CREATE UNIQUE INDEX uq_users_reg_number ON users(reg_number);
CREATE INDEX idx_users_role ON users(role);

-- TABLE: equipment
CREATE TABLE equipment (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'available'
        CHECK (status IN ('available', 'in_use', 'maintenance', 'broken'))
);

CREATE INDEX idx_equipment_status ON equipment(status);

-- TABLE: equipment_bookings
CREATE TABLE equipment_bookings (
    id BIGSERIAL PRIMARY KEY,
    equipment_id BIGINT NOT NULL,
    user_id BIGINT NOT NULL,
    start_date TIMESTAMPTZ NOT NULL,
    end_date TIMESTAMPTZ NOT NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'pending_approval'
        CHECK (status IN ('pending_approval', 'approved', 'rejected', 'returned')),
    notes TEXT NULL,
    return_proof_url TEXT NULL,
    CONSTRAINT fk_equipment_bookings_equipment
        FOREIGN KEY (equipment_id) 
        REFERENCES equipment(id) 
        ON DELETE CASCADE,
    CONSTRAINT fk_equipment_bookings_user
        FOREIGN KEY (user_id) 
        REFERENCES users(id) 
        ON DELETE CASCADE
);

-- TABLE: research_projects
CREATE TABLE research_projects (
    id BIGSERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    start_date DATE NULL,
    end_date DATE NULL,
    publication_url TEXT NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'pending_approval'
        CHECK (status IN ('pending_approval', 'approved_by_dospem', 'approved_by_head', 'completed', 'rejected')),
    user_id BIGINT NULL,
    dospem_id BIGINT NULL,
    rejection_reason TEXT NULL,
    CONSTRAINT fk_research_projects_user
        FOREIGN KEY (user_id) 
        REFERENCES users(id) 
        ON DELETE SET NULL,
    CONSTRAINT fk_research_projects_dospem
        FOREIGN KEY (dospem_id) 
        REFERENCES users(id) 
        ON DELETE SET NULL
);

-- TABLE: news
CREATE TABLE news (
    id BIGSERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    image_url TEXT NULL,
    author_id BIGINT NOT NULL,
    published_at TIMESTAMPTZ NULL,
    CONSTRAINT fk_news_author
        FOREIGN KEY (author_id) 
        REFERENCES users(id) 
        ON DELETE SET NULL
);

-- TABLE: datasets
CREATE TABLE datasets (
    id BIGSERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NULL,
    urls JSONB NOT NULL DEFAULT '[]',
    file_url TEXT NOT NULL,
    tags TEXT[] NULL
);

-- TABLE: registration_requests
CREATE TABLE registration_requests (
    id BIGSERIAL PRIMARY KEY,
    nim VARCHAR(20) NOT NULL,
    name VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    registration_purpose TEXT,
    dospem_id BIGINT NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'pending_approval'
        CHECK (status IN (
        'pending_approval',
        'approved_by_dospem',
        'approved_by_head',
        'rejected'
    )),
    rejection_reason TEXT NULL,
    CONSTRAINT fk_registration_requests_dospem
        FOREIGN KEY (dospem_id) 
        REFERENCES users(id) 
        ON DELETE SET NULL
);

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