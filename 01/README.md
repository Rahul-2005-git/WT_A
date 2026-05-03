# Responsive CV Web Page

A modern, responsive Curriculum Vitae (CV) web page with video background, multi-column layouts, and interactive features using Bootstrap 5, jQuery, and custom CSS animations.

## Features

- **Video Background** - Animated video hero section
- **Responsive Design** - Works perfectly on desktop, tablet, and mobile
- **Multi-Column Layouts** - Professional grid layouts using Bootstrap
- **Smooth Animations** - CSS animations and jQuery effects
- **Sticky Navigation** - Easy navigation with smooth scrolling
- **Interactive Elements** - Hover effects, form validation, and scroll animations
- **Print-Friendly** - Can be printed as PDF directly from browser
- **Multiple Sections** - About, Skills, Experience, Education, Projects, Contact

## Quick Start

### Option 1: Direct File Opening
1. Open `index.html` directly in your web browser
2. That's it! No server setup needed.

### Option 2: Using Local Server (Recommended)

**Using Python:**
```bash
# Python 3.x
python -m http.server 8000

# Python 2.x
python -m SimpleHTTPServer 8000
```

**Using Node.js (http-server):**
```bash
# Install globally (one-time)
npm install -g http-server

# Run in the 01 folder
http-server
```

**Using VS Code Live Server Extension:**
1. Install "Live Server" extension in VS Code
2. Right-click on `index.html` → "Open with Live Server"

Visit `http://localhost:8000` in your browser.

## File Structure

```
01/
├── index.html          # Main HTML file
├── styles.css          # Custom styles & animations
├── script.js           # jQuery functionality
└── README.md           # This file
```

## How to Customize

### Edit Your Information
- Open `index.html` in a text editor
- Search for placeholder text like "Your Name", "your.email@example.com"
- Replace with your actual information
- Update social media links

### Change Video Background
- Line 24 in `index.html`: Replace video source URL
- Use any MP4 video URL or upload your own file

### Update Skills
- Sections around lines 170-210 in `index.html`
- Add/remove skill cards as needed

### Modify Colors
- Primary gradient: `#667eea` to `#764ba2`
- Edit in `styles.css` or `index.html`

### Add Your Profile Image
- Replace placeholder image URL (line 96)
- Use 300x300px image for best results

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers

## Dependencies

All dependencies are loaded from CDN (no local installation needed):
- Bootstrap 5.3.0
- jQuery 3.6.0
- Font Awesome 6.4.0

## Printing / PDF Export

1. **Press Ctrl+P** (Windows/Linux) or **Cmd+P** (Mac)
2. Select "Save as PDF"
3. Adjust margins as needed
4. Click "Save"

*Note: Video background won't print; content will be clean and professional.*

## jQuery Functions

- Smooth anchor scrolling
- Active navigation on scroll
- Form submission handling
- Scroll-triggered animations
- Mobile navbar collapse

## Tips & Tricks

- **Keyboard Shortcut**: Press Ctrl+P to print/export as PDF
- **Mobile Testing**: Check responsive design using browser DevTools
- **Video Issues**: If video doesn't load, check your internet connection
- **Performance**: Optimize image sizes for faster loading

## Common Issues & Solutions

**Video not loading?**
- Check internet connection
- Try a different video URL
- Use a local video file instead

**Styles not applied?**
- Clear browser cache (Ctrl+Shift+Delete)
- Hard refresh (Ctrl+Shift+R)

**jQuery not working?**
- Check browser console for errors (F12)
- Ensure jQuery CDN is accessible

## SEO & Metadata

Update the following in `index.html`:
- `<title>` - Change from "My Professional CV"
- `<meta name="description">` - Add your CV description
- Social media links in contact section

## Additional Features to Add

- Dark mode toggle (CSS prepared in script.js)
- Experience/skill filtering
- Multi-language support
- PDF download button
- Resume upload/download section

## License

Free to use and modify for personal projects.

## Notes

- Replace all placeholder images and information with your own
- Video background auto-plays on desktop; check mobile video autoplay policies
- Contact form is for demonstration; connect to backend for actual email functionality
- Customize colors in `styles.css` for your brand

---

**Made with Bootstrap 5 + jQuery + CSS3 Animations**

For updates or issues, refer to Bootstrap documentation: https://getbootstrap.com/docs/5.3/
