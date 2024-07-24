import React, { useState } from 'react';
import { Calendar, momentLocalizer } from 'react-big-calendar';
import moment from 'moment';
import 'react-big-calendar/lib/css/react-big-calendar.css';

const localizer = momentLocalizer(moment);

const MyCalendar = () => {
  const [events, setEvents] = useState([
    {
      title: 'Réunion',
      start: new Date(),
      end: new Date(moment().add(1, 'hours').toDate()),
    },
    {
        title: 'Déjeuner',
        start: new Date(2024, 6, 20, 12, 0), // 20 juillet 2024, 12:00
        end: new Date(2024, 6, 20, 14, 0), // 20 juillet 2024, 14:00
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
      />
    </div>
  );
};

export default MyCalendar;