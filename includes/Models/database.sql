
/**
 * Author:  Adurotimi Joshua
 * Created: Oct 26, 2018
 */

CREATE TABLE users(
    id int(11) NOT NULL auto_increament,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(40) NOT NULL,
    first_name VARCHAR(30) NOT NULL,
    last_name VARCHAR(30) NOT NULL,
    PRIMARY KEY (id)
);
/*to create a new user
*/

GRANT ALL PRIVILEGES ON photo_gallery.*
TO 'gallery'@'localhost' IDENTIFIED BY 'passcode1995';