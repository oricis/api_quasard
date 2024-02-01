-- --------------------------------------------------------
-- MySQL 8.0.36-0ubuntu0.20.04.1
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS users (
  id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  name varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  email varchar(150) COLLATE utf8mb4_unicode_ci,
  password varchar(90) COLLATE utf8mb4_unicode_ci,

  active tinyint(1) UNSIGNED NOT NULL DEFAULT 1,

  created_at timestamp NULL DEFAULT NOW(),
  updated_at timestamp NULL DEFAULT NOW(),
  deleted_at timestamp NULL DEFAULT NULL,

  PRIMARY KEY (id),
  UNIQUE KEY users_email_unique (email),
  UNIQUE KEY users_name_unique (name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS notes (
  id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  text varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  user_id bigint(20) UNSIGNED NOT NULL,

  created_at timestamp NULL DEFAULT NOW(),
  updated_at timestamp NULL DEFAULT NOW(),
  deleted_at timestamp NULL DEFAULT NULL,

  PRIMARY KEY (id),
  KEY notes_to_users_fk (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS categories (
  id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  name varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  description varchar(60) COLLATE utf8mb4_unicode_ci,
  active tinyint(1) UNSIGNED NOT NULL DEFAULT 1,

  created_at timestamp NULL DEFAULT NOW(),
  updated_at timestamp NULL DEFAULT NOW(),
  deleted_at timestamp NULL DEFAULT NULL,

  PRIMARY KEY (id),
  UNIQUE KEY categories_name_unique (name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS category_note (
  id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  category_id bigint(20) UNSIGNED NOT NULL,
  note_id bigint(20) UNSIGNED NOT NULL,

  created_at timestamp NULL DEFAULT NOW(),
  deleted_at timestamp NULL DEFAULT NULL,

  PRIMARY KEY (id),
  KEY category_note_to_categories_fk (category_id),
  KEY category_note_to_notes_fk (note_id)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
