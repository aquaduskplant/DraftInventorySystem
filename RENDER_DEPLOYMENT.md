# Render Deployment Guide

This guide will help you deploy the Draft Inventory System to Render.

## Prerequisites

1. A [Render](https://render.com) account (free tier available)
2. Your code pushed to a Git repository (GitHub, GitLab, or Bitbucket)

## Deployment Steps

### Option 1: Using render.yaml (Recommended)

1. **Push your code to a Git repository** (if not already done)
   ```bash
   git add .
   git commit -m "Add Render deployment configuration"
   git push origin main
   ```

2. **Connect your repository to Render**
   - Go to [Render Dashboard](https://dashboard.render.com)
   - Click "New +" → "Blueprint"
   - Connect your Git repository
   - Render will automatically detect the `render.yaml` file

3. **Review and Deploy**
   - Render will show you the services it will create (web service and database)
   - Review the configuration
   - Click "Apply" to create the services
   - Render will automatically deploy your application

### Option 2: Manual Setup

If you prefer to set up manually:

1. **Create a PostgreSQL Database**
   - Go to Render Dashboard → "New +" → "PostgreSQL"
   - Name it: `draft-inventory-db`
   - Note the connection details

2. **Create a Web Service**
   - Go to Render Dashboard → "New +" → "Web Service"
   - Connect your Git repository
   - Configure:
     - **Name**: `draft-inventory-system`
     - **Environment**: `PHP`
     - **Build Command**: `./render-build.sh`
     - **Start Command**: `php artisan serve --host=0.0.0.0 --port=$PORT`
     - **Plan**: Starter (or your preferred plan)

3. **Set Environment Variables**
   Add these environment variables in the Render dashboard:
   ```
   APP_ENV=production
   APP_DEBUG=false
   LOG_CHANNEL=stderr
   DB_CONNECTION=mysql
   DB_HOST=<from database>
   DB_PORT=<from database>
   DB_DATABASE=<from database>
   DB_USERNAME=<from database>
   DB_PASSWORD=<from database>
   CACHE_DRIVER=file
   SESSION_DRIVER=database
   QUEUE_CONNECTION=sync
   FILESYSTEM_DISK=local
   ```

   **Note**: For database variables, use Render's "Link Database" feature to automatically inject connection details.

4. **Generate APP_KEY**
   - After first deployment, SSH into the service or use Render's shell
   - Run: `php artisan key:generate --force`
   - Or add it as an environment variable: `APP_KEY` (Render can auto-generate this)

## Important Notes

### Storage Directory
Laravel requires write access to the `storage` and `bootstrap/cache` directories. Render's filesystem is ephemeral, so:

- **File uploads**: Consider using S3 or another cloud storage service for production
- **Logs**: Logs are written to `stderr` and visible in Render's logs
- **Cache**: File-based cache works but is ephemeral (resets on deploy)

### Database Migrations
Migrations run automatically during the build process. If you need to run them manually:

```bash
php artisan migrate --force
```

### Updating the Application
Simply push to your Git repository, and Render will automatically:
1. Build the application
2. Run migrations
3. Deploy the new version

## Troubleshooting

### Build Fails
- Check the build logs in Render dashboard
- Ensure `render-build.sh` is executable (it should be, but if not, run `chmod +x render-build.sh`)
- Verify all dependencies are in `composer.json` and `package.json`

### Database Connection Issues
- Verify database environment variables are correctly linked
- Check that the database is running and accessible
- Ensure `DB_CONNECTION=mysql` matches your database type

### Application Errors
- Check the logs in Render dashboard
- Verify `APP_KEY` is set
- Ensure all required environment variables are configured
- Check that migrations ran successfully

### Storage Permissions
If you see storage permission errors:
- Render handles this automatically, but if issues persist, you may need to adjust file permissions in your build script

## Environment Variables Reference

| Variable | Description | Required |
|----------|-------------|----------|
| `APP_ENV` | Application environment | Yes (set to `production`) |
| `APP_DEBUG` | Debug mode | Yes (set to `false`) |
| `APP_KEY` | Application encryption key | Yes (auto-generated) |
| `APP_URL` | Application URL | Yes (auto-set by Render) |
| `DB_CONNECTION` | Database type | Yes (`mysql`) |
| `DB_HOST` | Database host | Yes (from database) |
| `DB_PORT` | Database port | Yes (from database) |
| `DB_DATABASE` | Database name | Yes (from database) |
| `DB_USERNAME` | Database username | Yes (from database) |
| `DB_PASSWORD` | Database password | Yes (from database) |
| `CACHE_DRIVER` | Cache driver | No (default: `file`) |
| `SESSION_DRIVER` | Session driver | No (default: `database`) |
| `QUEUE_CONNECTION` | Queue driver | No (default: `sync`) |

## Support

For Render-specific issues, check:
- [Render Documentation](https://render.com/docs)
- [Render Community](https://community.render.com)

For Laravel-specific issues, check:
- [Laravel Documentation](https://laravel.com/docs)

