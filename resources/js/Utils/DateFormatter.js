export default {
    formatDate(date, options = { year: 'numeric', month: 'long', day: 'numeric' }, locale = 'en-US') {
      try {
        const formattedDate = new Date(date).toLocaleDateString(locale, options);
        return formattedDate;
      } catch (error) {
        console.error('Error formatting date:', error);
        return 'Invalid Date';
      }
    },
  };

