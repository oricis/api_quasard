-- --------------------------------------------------------

INSERT INTO `users` (`id`, `name`, `email`, `password`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(NULL, 'foo', 'foo@mail.com', NULL, '1', NOW(), NOW(), NULL),
(NULL, 'baz', 'baz@mail.com', NULL, '1', NOW(), NOW(), NULL);

-- --------------------------------------------------------

INSERT INTO `categories` (`id`, `name`, `description`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(NULL, 'private', 'Private notes', '1', NOW(), NOW(), NULL),
(NULL, 'daily routines', NULL, '1', NOW(), NOW(), NULL),
(NULL, 'work', 'Work notes', '1', NOW(), NOW(), NULL);

-- --------------------------------------------------------

INSERT INTO `notes` (`id`, `text`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(NULL, 'Lorem ipsum', '1', NOW(), NOW(), NULL),
(NULL, 'Lorem ipsum set amet', '1', NOW(), NOW(), NULL),
(NULL, 'One note', '2', NOW(), NOW(), NULL);

-- --------------------------------------------------------

INSERT INTO `category_note` (`id`, `category_id`, `note_id`, `created_at`, `deleted_at`) VALUES
(NULL, '1', '1', NOW(), NULL),
(NULL, '1', '2', NOW(), NULL),
(NULL, '3', '3', NOW(), NULL);

-- --------------------------------------------------------
