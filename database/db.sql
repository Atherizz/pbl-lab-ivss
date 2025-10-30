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
    image_url TEXT NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'available'
        CHECK (status IN ('available', 'in_use', 'maintenance', 'broken'))
);

CREATE INDEX idx_equipment_status ON equipment(status);

CREATE TABLE research_projects (
    id BIGSERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    start_date DATE NULL,
    end_date DATE NULL,
    publication_url TEXT NULL
);

CREATE TABLE research_user (
    id BIGSERIAL PRIMARY KEY,
    user_id BIGINT NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    research_project_id BIGINT NOT NULL REFERENCES research_projects(id) ON DELETE CASCADE,
    UNIQUE(user_id, research_project_id) 
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