CREATE TABLE tests(
    
    -- PRIMARY KEY
    testId INT NOT NULL AUTO_INCREMENT,

    -- COLUMNS
    testName VARCHAR(50),
    testAudio VARCHAR(50),

    -- CONSTRAINT
    CONSTRAINT PK_testId PRIMARY KEY (testId)
);

CREATE TABLE questions(

    -- PRIMARY KEY
    questionId INT NOT NULL AUTO_INCREMENT,

    -- FOREIGN KEY
    testId INT NOT NULL,

    -- COLUMNS
    questionNumber INT NOT NULL,
    question TEXT NULL,
    questionType VARCHAR(100) NULL,
    answerA TEXT ,
    answerB TEXT ,
    answerC TEXT ,
    answerD TEXT ,
    correctAnswer VARCHAR(100),

    -- CONSTRAINT
    CONSTRAINT PK_questionId PRIMARY KEY (questionId),
    CONSTRAINT FK_quizId FOREIGN KEY (testId) REFERENCES Tests(testId)
);

CREATE TABLE instructors(
    
    -- PRIMARY KEY
    instructorId INT NOT NULL AUTO_INCREMENT,

    -- COLUMNS
    instructorRank VARCHAR(50),
    instructorName VARCHAR(100),

    -- CONSTRAINT
    CONSTRAINT PK_instructorId PRIMARY KEY (instructorId)
);

CREATE TABLE users(

    -- PRIMARY KEY
    userId INT NOT NULL AUTO_INCREMENT,

    -- COLUMNS
    userName VARCHAR(100),
    userPassword VARCHAR(255),

    -- CONSTRAINT
    CONSTRAINT PK_userId PRIMARY KEY (userId)
);


CREATE TABLE candidats(

    -- PRIMARY KEY
    candidatId INT NOT NULL AUTO_INCREMENT,

    -- FOREIGN KEY
    candidatTestId INT NOT NULL,

    -- COLUMNS
    candidatLastname VARCHAR(150) NOT NULL,
    candidatFistname VARCHAR(150) NOT NULL,
    candidatMatricule VARCHAR(150) NOT NULL,
    candidatService VARCHAR(150) NOT NULL,
    candidatRank VARCHAR(150) NOT NULL,
    candidatCountry VARCHAR(150) NOT NULL,
    candidatInstructorName VARCHAR(150) NOT NULL,

    -- CONSTRAINT
    CONSTRAINT PK_candidatId PRIMARY KEY (candidatId)
);


CREATE TABLE scores
(
    -- PRIMARY KEY
    scoreId INT NOT NULL AUTO_INCREMENT,

    -- FOREIGN KEY
    testId INT NOT NULL,
    candidatId INT NOT NULL,

    -- COLUMNS
    listening int,
    reading int,

    -- CONSTRAINT
    CONSTRAINT FK_testId FOREIGN KEY (testId) REFERENCES tests(testId),
    CONSTRAINT PK_scoreId PRIMARY KEY (scoreId)    
);

