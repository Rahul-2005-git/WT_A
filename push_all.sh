#!/bin/bash
# Run this from inside the assignments folder
# Usage: ./push_all.sh YOUR_GITHUB_USERNAME

USERNAME="${1:-YOUR_GITHUB_USERNAME}"

if [ "$USERNAME" = "YOUR_GITHUB_USERNAME" ]; then
  echo "Usage: ./push_all.sh YOUR_GITHUB_USERNAME"
  exit 1
fi

TITLES=(
  [11]="PHP Session Limiter max 3 concurrent sessions 5-min timeout"
  [12]="Attendance System Student registration Teacher online attendance"
  [13]="PHP Login Module with Cookies Sessions and MySQL"
  [14]="Online Bookstore Spring Boot MySQL"
  [15]="College Complaint Registration System PHP MySQL"
  [16]="Currency Converter ReactJS USD to INR"
  [17]="Waste Collection System PHP MySQL"
  [18]="Complaint Management System PMC PMT PHP MySQL"
  [19]="Airplane Seat Booking System PHP MySQL"
  [20]="Tic-Tac-Toe Game PHP Sessions"
)

for i in {11..20}; do
  echo ""
  echo "=========================================="
  echo "Pushing assignment-$i..."
  echo "=========================================="
  cd "assignment-$i"
  git init
  git add .
  git commit -m "Assignment $i: ${TITLES[$i]}"
  git branch -M main
  git remote remove origin 2>/dev/null || true
  git remote add origin "https://github.com/$USERNAME/assignment-$i.git"
  git push -u origin main
  cd ..
done
echo ""
echo "All assignments pushed to GitHub!"
