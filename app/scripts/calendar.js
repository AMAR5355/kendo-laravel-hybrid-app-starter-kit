(function (root) {
	function Calendar () {
		this.SUNDAY = 0;
		this.MONDAY = 1;
		this.SATURDAY = 6;
		this.MONDAY_WEEK = ['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN'];
		this.SATURDAY_WEEK = ['SAT', 'SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI'];
		this.SUNDAY_WEEK = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];
	}

	Calendar.prototype.getWeek = function (date, startOfWeek) {
		if (startOfWeek == null) {
			startOfWeek = this.SUNDAY
		}
		var date = moment(date),
		begin = moment(date).startOf('week').isoWeekday(startOfWeek);

		//-- TODO: This could be the wrong week.
		var week = [];
		for (var i = 0; i < 7; i++) {
			week.push(begin.clone());
			begin.add('d', 1);
		}
		
		return week;
	};

	Calendar.prototype.getDefaultWeek = function (startDayOfWeek) {
		if (startDayOfWeek == null) {
			startDayOfWeek = app.session.startDayOfWeek || this.SUNDAY;
		}

		if (startDayOfWeek === this.SUNDAY) {
			return this.SUNDAY_WEEK;
		} else if (startDayOfWeek === this.SATURDAY) {
			return this.SATURDAY_WEEK;
		} else if (startDayOfWeek === this.MONDAY) {
			return this.MONDAY_WEEK;
		} else {
			return this.SUNDAY_WEEK;
		}
	};


	Calendar.prototype.getMonth = function (date, startOfWeek) {
		var currentMonth = date.format('M');
		var weeks = [];

		//-- Go back until the first of this month
		var week, hasMonth;
		var currentWeek = new moment(date).subtract('weeks', 5); 
		do {
			week = this.getWeek(currentWeek, startOfWeek);
			var hasMonth = week.reduce(function (lastMatch, current, index) {
				if (current.format('M') === currentMonth) {
					return current;
				} else {
					return lastMatch; 
				}
			}).format('M') === currentMonth;
			if (hasMonth) {
				weeks.push(week);
			}
			currentWeek = currentWeek.add('weeks', 1);
		} while (hasMonth === false);
		//-- Go forward until the last of this month
		do {
			week = this.getWeek(currentWeek, startOfWeek);
			var hasMonth = week.reduce(function (lastMatch, current, index) {
				if (current.format('M') === currentMonth) {
					return current;
				} else {
					return lastMatch; 
				}
			}).format('M') === currentMonth;
			if (hasMonth) {
				weeks.push(week);
			}
			currentWeek = currentWeek.add('weeks', 1);
		} while (hasMonth === true);

		return weeks;
	};
	
	root.$calendar = new Calendar();
} (window))