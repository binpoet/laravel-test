export default class DateFormatter {
    static formatDate(date, locale = 'en-US', options = {}) {
        options = {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            ...options,
        };
        return new Intl.DateTimeFormat(locale, options).format(new Date(date));
    }
}
