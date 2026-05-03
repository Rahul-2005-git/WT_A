# Electricity Bill Calculator

A responsive PHP web application to calculate electricity bills with tiered pricing structure.

## Pricing Structure

- **Units 1-50:** Rs 3.50/unit
- **Units 51-150:** Rs 4.00/unit  
- **Units 151-250:** Rs 5.20/unit
- **Units 250+:** Rs 6.50/unit

## How to Run

### Option 1: Using PHP Built-in Server (Recommended)

1. Open PowerShell/Command Prompt
2. Navigate to the 06 folder:
   ```bash
   cd "d:\Kunal Files\SEM 6\Web Technology\Lab_Exam\06"
   ```
3. Start PHP server:
   ```bash
   php -S localhost:8000
   ```
4. Open browser and go to: `http://localhost:8000`

### Option 2: Using XAMPP/WAMP/LAMP

1. Copy the entire 06 folder to `htdocs` (XAMPP) or `www` (WAMP)
2. Start Apache and MySQL
3. Visit: `http://localhost/06/` or `http://localhost/06/index.php`

### Option 3: Online PHP Playground

Upload files to: https://www.php.net/cloud

## Features

✅ **User-Friendly Form** - Simple input for units  
✅ **Automatic Calculation** - Tiered pricing applied instantly  
✅ **Detailed Breakdown** - Shows calculation for each tier  
✅ **Pricing Table** - Clear display of rates  
✅ **Examples** - Pre-calculated examples  
✅ **Responsive Design** - Works on desktop, tablet, mobile  
✅ **Form Validation** - Input validation on server side  

## Files

- `index.php` - Main PHP calculator
- `styles.css` - Responsive styling
- `README.md` - This file

## How to Use

1. Enter total units consumed
2. Click "Calculate Bill"
3. View detailed breakdown
4. See total bill amount

## Examples

**50 units:** Rs 175.00 (50 × 3.50)

**120 units:** Rs 455.00
- 50 × 3.50 = 175
- 70 × 4.00 = 280

**300 units:** Rs 1,420.00
- 50 × 3.50 = 175
- 100 × 4.00 = 400
- 100 × 5.20 = 520
- 50 × 6.50 = 325

## Browser Compatibility

Chrome, Firefox, Safari, Edge (all latest versions)

## Notes

- Supports decimal units (e.g., 120.50)
- No database required
- Pure PHP calculation
- No external dependencies

Done! 🎉
