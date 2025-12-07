# Step-by-Step Guide: Deploy to Render

Follow these steps to deploy your Laravel application to Render.

## Step 1: Prepare Your Code

1. **Make sure all your code is committed to Git**
   ```bash
   git add .
   git commit -m "Prepare for Render deployment"
   ```

2. **Push to your Git repository** (GitHub, GitLab, or Bitbucket)
   ```bash
   git push origin main
   ```
   (Replace `main` with your branch name if different)

## Step 2: Create a Render Account

1. Go to [https://render.com](https://render.com)
2. Click **"Get Started for Free"** or **"Sign Up"**
3. Sign up using GitHub, GitLab, or email
4. Verify your email if required

## Step 3: Create a PostgreSQL Database

1. In the Render dashboard, click **"New +"** button (top right)
2. Select **"PostgreSQL"**
3. Fill in the details:
   - **Name**: `draft-inventory-db`
   - **Database**: `draft_inventory`
   - **User**: `draft_user`
   - **Region**: Choose closest to you
   - **PostgreSQL Version**: Latest (or default)
   - **Plan**: Starter (Free tier available)
4. Click **"Create Database"**
5. **Wait for the database to be created** (takes 1-2 minutes)
6. **Note down the connection details** - you'll need them later:
   - Internal Database URL = postgresql://draft_user:vf11a5iIkc8BkwmswqHcniFFqFg2IVkr@dpg-d4lgj2i4d50c73e2u4g0-a/draft_inventory
   - Host = dpg-d4lgj2i4d50c73e2u4g0-a
   - Port = 5432
   - Database name = draft_inventory
   - Username = draft_user
   - Password = vf11a5iIkc8BkwmswqHcniFFqFg2IVkr

## Step 4: Create the Web Service

1. In the Render dashboard, click **"New +"** button again
2. Select **"Web Service"**
3. **Connect your repository**:
   - If using GitHub/GitLab: Click **"Connect account"** and authorize Render
   - Select your repository: `it107finalprojectDeploy` (or your repo name)
   - Click **"Connect"**

4. **Configure the service**:
   - **Name**: `draft-inventory-system`
   - **Region**: Same as your database
   - **Branch**: `main` (or your default branch)
   - **Root Directory**: `DraftInventorySystem` (important!)
   - **Runtime**: `PHP`
   - **Build Command**: `./render-build.sh`
   - **Start Command**: `php artisan serve --host=0.0.0.0 --port=$PORT`
   - **Plan**: Starter (Free tier available)

5. Click **"Advanced"** to add environment variables

## Step 5: Configure Environment Variables

In the **Environment Variables** section, add these variables:

### Required Variables:

1. **APP_ENV**
   - Key: `APP_ENV`
   - Value: `production`

2. **APP_DEBUG**
   - Key: `APP_DEBUG`
   - Value: `false`

3. **APP_KEY**
   - Key: `APP_KEY`
   - Value: Leave empty (we'll generate it after first deploy)
   - OR click **"Generate"** if Render has that option

4. **LOG_CHANNEL**
   - Key: `LOG_CHANNEL`
   - Value: `stderr`

5. **Database Connection**
   - Key: `DB_CONNECTION`
   - Value: `pgsql`

6. **Link Database** (Easiest method):
   - Click **"Link Database"** or **"Add from Database"**
   - Select: `draft-inventory-db`
   - Render will automatically add:
     - `DB_HOST`
     - `DB_PORT`
     - `DB_DATABASE`
     - `DB_USERNAME`
     - `DB_PASSWORD`

   **OR manually add** (if linking doesn't work):
   - `DB_HOST`: (from database details)
   - `DB_PORT`: (from database details, usually `5432`)
   - `DB_DATABASE`: `draft_inventory`
   - `DB_USERNAME`: `draft_user`
   - `DB_PASSWORD`: (from database details)

7. **Additional Variables**:
   - Key: `CACHE_DRIVER`
   - Value: `file`

   - Key: `SESSION_DRIVER`
   - Value: `database`

   - Key: `QUEUE_CONNECTION`
   - Value: `sync`

   - Key: `FILESYSTEM_DISK`
   - Value: `local`

## Step 6: Deploy

1. Scroll down and click **"Create Web Service"**
2. Render will start building your application
3. **Watch the build logs** - you can see the progress in real-time
4. The build process will:
   - Install PHP dependencies (Composer)
   - Install Node.js dependencies (npm)
   - Build frontend assets
   - Run database migrations
   - Optimize the application

## Step 7: Generate Application Key (If Needed)

After the first deployment:

1. If you see errors about `APP_KEY`, you need to generate it:
   - Go to your service in Render dashboard
   - Click on **"Shell"** tab (or use SSH)
   - Run: `php artisan key:generate --force`
   - Copy the generated key
   - Go to **"Environment"** tab
   - Update `APP_KEY` with the generated value
   - Click **"Save Changes"** (this will trigger a redeploy)

## Step 8: Verify Deployment

1. Once deployment is complete, Render will provide a URL like:
   `https://draft-inventory-system.onrender.com`

2. **Test your application**:
   - Visit the URL in your browser
   - Check if the homepage loads
   - Try logging in (if you have user accounts)
   - Verify database connections work

3. **Check logs** if something doesn't work:
   - Go to your service → **"Logs"** tab
   - Look for any error messages

## Step 9: Set Up Custom Domain (Optional)

1. In your service settings, go to **"Custom Domains"**
2. Add your domain name
3. Follow Render's instructions to update DNS records

## Troubleshooting

### Build Fails
- Check the build logs for specific errors
- Ensure `render-build.sh` file exists in `DraftInventorySystem` folder
- Verify all dependencies are in `composer.json` and `package.json`

### Database Connection Errors
- Verify database is running (check database dashboard)
- Double-check environment variables match database credentials
- Ensure `DB_CONNECTION=pgsql` is set

### Application Key Error
- Generate key using: `php artisan key:generate --force` in Shell
- Add it to environment variables

### 500 Errors
- Check application logs in Render dashboard
- Verify all environment variables are set
- Ensure migrations ran successfully

### Storage Permission Errors
- This is usually handled automatically by Render
- If issues persist, check that `storage` and `bootstrap/cache` directories exist

## Updating Your Application

To update your application after making changes:

1. **Commit and push your changes**:
   ```bash
   git add .
   git commit -m "Your update message"
   git push origin main
   ```

2. **Render will automatically detect the push** and start a new deployment
3. **Monitor the deployment** in the Render dashboard
4. Your app will be updated once deployment completes

## Important Notes

- **Free tier limitations**: Free tier services spin down after 15 minutes of inactivity
- **Database**: Free tier PostgreSQL has limitations (90 days, 1GB storage)
- **Storage**: File uploads are ephemeral - consider using S3 for production
- **Logs**: Check logs regularly in the Render dashboard

## Need Help?

- Render Documentation: https://render.com/docs
- Render Community: https://community.render.com
- Laravel Documentation: https://laravel.com/docs

