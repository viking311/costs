CREATE TABLE "users"(
                        "id" SERIAL NOT NULL,
                        "user_name" VARCHAR(255) NOT NULL,
                        "chat_id" BIGINT NOT NULL
);
ALTER TABLE
    "users" ADD CONSTRAINT "users_user_name_chat_id_unique" UNIQUE("user_name", "chat_id");
ALTER TABLE
    "users" ADD PRIMARY KEY("id");
CREATE TABLE "costs"(
                        "id" SERIAL NOT NULL,
                        "cost_date" TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL,
                        "amount" DECIMAL(8, 2) NOT NULL,
                        "comment" TEXT NOT NULL,
                        "user_id" BIGINT NOT NULL
);
ALTER TABLE
    "costs" ADD PRIMARY KEY("id");
ALTER TABLE
    "costs" ADD CONSTRAINT "costs_user_id_foreign" FOREIGN KEY("user_id") REFERENCES "users"("id");