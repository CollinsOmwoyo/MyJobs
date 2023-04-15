CREATE TABLE employers (
  employer_name VARCHAR(255) NOT NULL PRIMARY KEY,
  employer_icon VARCHAR(255),
  //will be updating this with BLOB soon
  job_types VARCHAR(255),
  current_applications INT
);

CREATE TABLE job_types (
  job_type VARCHAR(255) NOT NULL PRIMARY KEY,
  employers VARCHAR(255),
  salary VARCHAR(255),
  locations VARCHAR(255),
  sequence INT,
  FOREIGN KEY (employers) REFERENCES employers(employer_name) ON UPDATE CASCADE
);

CREATE TABLE job (
  job_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  employer_name VARCHAR(255) NOT NULL,
  job_name VARCHAR(255) NOT NULL,
  date_posted DATE NOT NULL,
  date_applied DATE NOT NULL,
  days_late INT AS (DATEDIFF(date_applied, date_posted)) VIRTUAL,
  source_reference VARCHAR(255),
  status VARCHAR(255) NOT NULL,
  FOREIGN KEY (employer_name) REFERENCES employers(employer_name) ON UPDATE CASCADE
);
