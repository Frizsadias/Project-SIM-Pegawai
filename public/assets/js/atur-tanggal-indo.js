moment.locale('id', {
    weekdays : ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'],
    weekdaysShort : ['Min','Sen','Sel','Rab','Kam','Jum','Sab'],
    weekdaysMin : ['Mg','Sn','Sl','Rb','Km','Jm','Sb'],
    months : ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'],
    monthsShort : ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des'],
    longDateFormat : {
        LT : 'HH:mm',
        LTS : 'HH:mm:ss',
        L : 'DD/MM/YYYY',
        LL : 'D MMMM YYYY',
        LLL : 'D MMMM YYYY LT',
        LLLL : 'dddd, D MMMM YYYY LT'
    },
    meridiemParse: /Pagi|Siang|Sore|Malam/,
    meridiemHour: function (hour, meridiem) {
        if (hour === 12) {
            hour = 0;
        }
        if (meridiem === 'Pagi') {
            return hour;
        } else if (meridiem === 'Siang') {
            return hour >= 11 ? hour : hour + 12;
        } else if (meridiem === 'Sore' || meridiem === 'Malam') {
            return hour + 12;
        }
    },
    meridiem : function (hours, minutes, isLower) {
        if (hours < 11) {
            return 'Pagi';
        } else if (hours < 15) {
            return 'Siang';
        } else if (hours < 19) {
            return 'Sore';
        } else {
            return 'Malam';
        }
    },
    calendar : {
        sameDay : '[Hari ini pukul] LT',
        nextDay : '[Besok pukul] LT',
        nextWeek : 'dddd [pukul] LT',
        lastDay : '[Kemarin pukul] LT',
        lastWeek : 'dddd [lalu pukul] LT',
        sameElse : 'L'
    },
    relativeTime : {
        future : 'dalam %s',
        past : '%s yang lalu',
        s : 'beberapa detik',
        ss : '%d detik',
        m : 'semenit',
        mm : '%d menit',
        h : 'sejam',
        hh : '%d jam',
        d : 'sehari',
        dd : '%d hari',
        M : 'sebulan',
        MM : '%d bulan',
        y : 'setahun',
        yy : '%d tahun'
    },
    dayOfMonthOrdinalParse : /\d{1,2}(st|nd|rd|th)/,
    ordinal : function (number) {
        var b = number % 10,
            output = (~~(number % 100 / 10) === 1) ? 'th' :
                (b === 1) ? 'st' :
                    (b === 2) ? 'nd' :
                        (b === 3) ? 'rd' : 'th';
        return number + output;
    },
    week : {
        dow : 1,
        doy : 4,
    }
});