const QuestionHelper = {
    data() {
        return {
            question_types: {
                fill_in_blanks: 1,
                dropdown: 2,
                multiple_choices: 3,
                radio_button: 4,
                checkbox_button: 5,
                ranking: {
                    extent: 6,
                    relevance: 7,
                    acceptance: 8
                }
            },
            ranking: {
                extent: {
                    value: 6,
                    data: {
                        5: {
                            text: 'Very great extent',
                            value: 5
                        },
                        4: {
                            text: 'Great extent',
                            value: 4
                        },
                        3: {
                            text: 'Good extent',
                            value: 3
                        },
                        2: {
                            text: 'Little extent',
                            value: 2
                        },
                        1: {
                            text: 'Not at all',
                            value: 1
                        },
                        0: {
                            text: 'Not applicable',
                            value: 0
                        }
                    }
                },
                relevance: {
                    value: 7,
                    data: {
                        5: {
                            text: 'Extremely relevant',
                            value: 5
                        },
                        4: {
                            text: 'Relevant',
                            value: 4
                        },
                        3: {
                            text: 'Somewhat relevant',
                            value: 3
                        },
                        2: {
                            text: 'Of little relevance',
                            value: 2
                        },
                        1: {
                            text: 'Not relevant',
                            value: 1
                        },
                        0: {
                            text: 'Not applicable',
                            value: 0
                        }
                    }
                },
                acceptance: {
                    value: 8,
                    data: {
                        5: {
                            text: 'Strongly agree',
                            value: 5
                        },
                        4: {
                            text: 'Agree',
                            value: 4
                        },
                        3: {
                            text: 'Neither agree nor disagree',
                            value: 3
                        },
                        2: {
                            text: 'Disagree',
                            value: 2
                        },
                        1: {
                            text: 'Strongly disagree',
                            value: 1
                        }
                    }
                },
            },
        }
    }
};

export default QuestionHelper;
