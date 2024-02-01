-- --------------------------------------------------------
-- MySQL 8.0.36-0ubuntu0.20.04.1
-- --------------------------------------------------------

ALTER TABLE notes
  ADD CONSTRAINT notes_to_users_fk
  FOREIGN KEY (user_id)
  REFERENCES users (id)
  ON DELETE CASCADE;

-- --------------------------------------------------------

ALTER TABLE category_note
  ADD CONSTRAINT category_note_to_categories_fk
  FOREIGN KEY (category_id)
  REFERENCES categories (id)
  ON DELETE CASCADE;

ALTER TABLE category_note
  ADD CONSTRAINT category_note_to_notes_fk
  FOREIGN KEY (note_id)
  REFERENCES notes (id)
  ON DELETE CASCADE;

-- --------------------------------------------------------
