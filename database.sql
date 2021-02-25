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
INSERT INTO users (userName, userPassword) VALUES
('admin', '$2y$10$bggvAwQiCtqtRM.G87SZPOjFUhC6qOSUjvybpxl6Dr2VYrfTT5oYO');


CREATE TABLE candidats(

    -- PRIMARY KEY
    candidatId INT NOT NULL AUTO_INCREMENT,

    -- FOREIGN KEY
    candidatTestId INT NOT NULL,
   
    -- COLUMNS
    candidatLastname VARCHAR(150) NOT NULL,
    candidatFirstName VARCHAR(150) NOT NULL,
    candidatMatricule VARCHAR(150) NOT NULL,
    candidatService VARCHAR(150) NOT NULL,
    candidatRank VARCHAR(150) NOT NULL,
    candidatCountry VARCHAR(150) NOT NULL,
    candidatInstructorName VARCHAR(150) NOT NULL,
    
    candidatListening int,
    candidatReading int,

    -- CONSTRAINT
    CONSTRAINT FK_testId FOREIGN KEY (candidatTestId) REFERENCES tests(testId),
    CONSTRAINT PK_candidatId PRIMARY KEY (candidatId)
);

