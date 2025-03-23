CREATE TABLE IF NOT EXISTS "migrations"(
  "id" integer primary key autoincrement not null,
  "migration" varchar not null,
  "batch" integer not null
);
CREATE TABLE IF NOT EXISTS "password_reset_tokens"(
  "email" varchar not null,
  "token" varchar not null,
  "created_at" datetime,
  primary key("email")
);
CREATE TABLE IF NOT EXISTS "sessions"(
  "id" varchar not null,
  "user_id" integer,
  "ip_address" varchar,
  "user_agent" text,
  "payload" text not null,
  "last_activity" integer not null,
  primary key("id")
);
CREATE INDEX "sessions_user_id_index" on "sessions"("user_id");
CREATE INDEX "sessions_last_activity_index" on "sessions"("last_activity");
CREATE TABLE IF NOT EXISTS "cache"(
  "key" varchar not null,
  "value" text not null,
  "expiration" integer not null,
  primary key("key")
);
CREATE TABLE IF NOT EXISTS "cache_locks"(
  "key" varchar not null,
  "owner" varchar not null,
  "expiration" integer not null,
  primary key("key")
);
CREATE TABLE IF NOT EXISTS "jobs"(
  "id" integer primary key autoincrement not null,
  "queue" varchar not null,
  "payload" text not null,
  "attempts" integer not null,
  "reserved_at" integer,
  "available_at" integer not null,
  "created_at" integer not null
);
CREATE INDEX "jobs_queue_index" on "jobs"("queue");
CREATE TABLE IF NOT EXISTS "job_batches"(
  "id" varchar not null,
  "name" varchar not null,
  "total_jobs" integer not null,
  "pending_jobs" integer not null,
  "failed_jobs" integer not null,
  "failed_job_ids" text not null,
  "options" text,
  "cancelled_at" integer,
  "created_at" integer not null,
  "finished_at" integer,
  primary key("id")
);
CREATE TABLE IF NOT EXISTS "failed_jobs"(
  "id" integer primary key autoincrement not null,
  "uuid" varchar not null,
  "connection" text not null,
  "queue" text not null,
  "payload" text not null,
  "exception" text not null,
  "failed_at" datetime not null default CURRENT_TIMESTAMP
);
CREATE UNIQUE INDEX "failed_jobs_uuid_unique" on "failed_jobs"("uuid");
CREATE TABLE IF NOT EXISTS "products"(
  "id" integer primary key autoincrement not null,
  "name" varchar not null,
  "owner_id" integer not null,
  "value" numeric not null,
  "quantity" integer not null default '1',
  "created_at" datetime,
  "updated_at" datetime,
  foreign key("owner_id") references "users"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "equivalences"(
  "id" integer primary key autoincrement not null,
  "created_at" datetime,
  "updated_at" datetime
);
CREATE TABLE IF NOT EXISTS "transactions"(
  "transaction_id" integer primary key autoincrement not null,
  "initiator_id" integer not null,
  "counterparty_id" integer not null,
  "partner_initiator_id" integer,
  "partner_counterparty_id" integer,
  "productp_id" integer not null,
  "producte_id" integer not null,
  "hashkey" varchar not null,
  "transaction_fee_total" numeric not null,
  "created_at" datetime not null default CURRENT_TIMESTAMP,
  "completed_at" datetime,
  "status" varchar check("status" in('Pending', 'Verified', 'Completed')) not null default 'Pending',
  foreign key("initiator_id") references "users"("id") on delete cascade,
  foreign key("counterparty_id") references "users"("id") on delete cascade,
  foreign key("partner_initiator_id") references "users"("id") on delete cascade,
  foreign key("partner_counterparty_id") references "users"("id") on delete cascade,
  foreign key("productp_id") references "products"("id") on delete cascade,
  foreign key("producte_id") references "products"("id") on delete cascade
);
CREATE UNIQUE INDEX "transactions_hashkey_unique" on "transactions"("hashkey");
CREATE TABLE IF NOT EXISTS "users"(
  "id" integer primary key autoincrement not null,
  "name" varchar not null,
  "email" varchar not null,
  "email_verified_at" datetime,
  "password" varchar not null,
  "remember_token" varchar,
  "created_at" datetime,
  "updated_at" datetime,
  "is_admin" tinyint(1) not null default('0'),
  "partner_id" integer,
  foreign key("partner_id") references users("id") on delete set null on update no action
);
CREATE UNIQUE INDEX "users_email_unique" on "users"("email");

INSERT INTO migrations VALUES(1,'0001_01_01_000000_create_users_table',1);
INSERT INTO migrations VALUES(2,'0001_01_01_000001_create_cache_table',1);
INSERT INTO migrations VALUES(3,'0001_01_01_000002_create_jobs_table',1);
INSERT INTO migrations VALUES(4,'2025_03_10_235903_add_is_admin_to_users_table',1);
INSERT INTO migrations VALUES(5,'2025_03_17_015716_create_products_table',1);
INSERT INTO migrations VALUES(6,'2025_03_23_000146_create_equivalences_table',2);
INSERT INTO migrations VALUES(7,'2025_03_23_001722_create_transactions_table',3);
INSERT INTO migrations VALUES(8,'2025_03_23_012823_add_partner_id_to_users_table',4);
INSERT INTO migrations VALUES(9,'2025_03_23_020450_update_partner_id_nullable_in_users_table',5);
