import './bootstrap.js';
import MyCalendar from './components/calendar.js';
import React from 'react';
import ReactDOM from 'react-dom/client';


if (document.getElementById('react-app')) {
    const root = ReactDOM.createRoot(document.getElementById('react-app'));
    root.render(<MyCalendar />);
}