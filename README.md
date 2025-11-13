# CBT Exam System — Pure PHP + Bootstrap 4 (Argon-like) — v3 (Render-ready)

This is a fixed, deploy-ready package for Render. It includes:
- Pure PHP server-rendered frontend (Bootstrap 4 / Argon-like)
- PostgreSQL via PDO (reads DATABASE_URL env var)
- Admin approval flow (users registered as 'pending' until admin approves)
- Phone number saved on registration and visible to admin
- Sample admin and user seeded automatically on first run (if not present)
- Assets correctly placed under /public/assets so styling works
- Dockerfile + render.yaml for Render deploy

Sample accounts (created if absent):
- Admin: admin@example.com / Admin@123
- User: user@example.com / User@123

## Deploy on Render (quick)
1. Push this repo to GitHub.
2. Create a Postgres database on Render (New -> Database).
3. Copy the External Connection URL from the DB (postgres://...).
4. On Render create a New Web Service -> connect repo -> Docker.
5. In Web Service Environment add:
   DATABASE_URL = <the connection string you copied>
6. Deploy. App will auto-run migrations and seed sample users.
7. Visit https://<your-service>.onrender.com/

