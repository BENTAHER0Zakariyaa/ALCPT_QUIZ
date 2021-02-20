CREATE TABLE questions(

    -- PRIMARY KEY
    questionId INT NOT NULL,

    -- COLUMNS
    question TEXT,
    
    -- CONSTRAINT
    CONSTRAINT PK_questionId PRIMARY KEY (questionId)
);

CREATE TABLE answers(

    -- PRIMARY KEY
    answerId INT NOT NULL AUTO_INCREMENT,

    -- FOREIGN KEY
    questionId INT NOT NULL,

    -- COLUMNS
    answer TEXT,
    isCorrect TINYINT(1),

    -- CONSTRAINT
    CONSTRAINT FK_questionId FOREIGN KEY (questionId) REFERENCES questions(questionId),
    CONSTRAINT PK_answerId PRIMARY KEY (answerId)
);

CREATE TABLE candidats(

    -- PRIMARY KEY
    candidatId INT NOT NULL AUTO_INCREMENT,

    -- COLUMNS
    candidatGrade VARCHAR(150) NOT NULL,
    candidatNom VARCHAR(150) NOT NULL,
    candidatPrenom VARCHAR(150) NOT NULL,
    candidatMatricule VARCHAR(150) NOT NULL,
    candidatService VARCHAR(150) NOT NULL,
    candidatEso VARCHAR(150) NOT NULL,

    -- CONSTRAINT
    CONSTRAINT PK_candidatId PRIMARY KEY (candidatId)
)