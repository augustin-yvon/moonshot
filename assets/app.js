import './bootstrap.js';
import MyCalendar from './components/calendar.js';
import React from 'react';
import ReactDOM from 'react-dom/client';

console.log("App.js is loaded"); // Diagnostic message

if (document.getElementById('react-app')) {
    console.log("React-app element found"); // Diagnostic message
    const root = ReactDOM.createRoot(document.getElementById('react-app'));
    root.render(<MyCalendar />);
} else {
    console.log("React-app element not found"); // Diagnostic message
}


document.querySelectorAll('.grade-data').forEach(element => {
    const grade = parseInt(element.getAttribute('data-grade'), 10);
    
    if (grade >= 85) {
        element.classList.add('high-grade');
    } else if (grade >= 50) {
        element.classList.add('mid-grade');
    } else {
        element.classList.add('low-grade');
    }
});