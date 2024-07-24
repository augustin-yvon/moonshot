import React, { useState } from 'react';
import { Calendar, momentLocalizer } from 'react-big-calendar';
import moment from 'moment';
import 'react-big-calendar/lib/css/react-big-calendar.css';

const localizer = momentLocalizer(moment);

const MyCalendar = () => {
  const [events, setEvents] = useState([
    {
      title: 'Symfony with Twig',
      start: new Date(2024, 6, 22, 10, 0),
      end: new Date(2024, 6, 22, 13, 0),
    },
    {
      title: 'English workshop',
      start: new Date(2024, 6, 23, 15, 0),
      end: new Date(2024, 6, 23, 17, 0),
    },
    {
      title: 'PHP 3/6',
      start: new Date(2024, 6, 25, 14, 0),
      end: new Date(2024, 6, 25, 16, 0),
    },
    {
        title: 'Project management',
        start: new Date(2024, 6, 26, 9, 0),
        end: new Date(2024, 6, 26, 12, 0),
      },
  ]);

  const minTime = new Date();
  minTime.setHours(9, 0, 0);

  const maxTime = new Date();
  maxTime.setHours(19, 0, 0);

  return (
    <div>
      <Calendar
        localizer={localizer}
        events={events}
        startAccessor="start"
        endAccessor="end"
        defaultView="week"
        min={minTime}
        max={maxTime}
        style={{ height: 500 }}
        views={['month', 'week', 'day', 'agenda']}
      />
    </div>
  );
};

export default MyCalendar;