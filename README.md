# IASBS-Chat-Room
Simple Chat Room

Create a MySQL database named 'chatroom'in phpmyadmin and add 3 tables with the following structures:
1) user
name	            varchar(50)	utf8mb4_0900_ai_ci	  No	None
family	          varchar(50)	utf8mb4_0900_ai_ci		Yes	NULL
username Primary	varchar(50)	utf8mb4_0900_ai_ci		No	None
password	        varbinary(150)			              No	None
email Index	      varchar(50)	utf8mb4_0900_ai_ci		No	None

2) chatlog
id Primary	int		UNSIGNED	                    No	None		AUTO_INCREMENT
mfrom Index	varchar(255)	utf8mb4_0900_ai_ci		No	None
mto Index	  varchar(255)	utf8mb4_0900_ai_ci		No	None
text	      text	        utf8mb4_0900_ai_ci		No	None
sent	      varchar(50)	  utf8mb4_0900_ai_ci		No	None

3) blocklist
user1 Primary	varchar(50)	utf8mb4_0900_ai_ci		No	None
user2 Primary	varchar(50)	utf8mb4_0900_ai_ci		No	None
status	      varchar(50)	utf8mb4_0900_ai_ci		Yes	NULL
