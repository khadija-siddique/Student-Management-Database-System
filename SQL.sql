SQL
CREATE DATABASE domain_intelligence;

USE domain_intelligence;

CREATE TABLE domains (
    id INT AUTO_INCREMENT PRIMARY KEY,
    domain_name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE whois_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    domain_id INT,
    owner_name VARCHAR(255),
    registrar VARCHAR(255),
    creation_date DATE,
    expiry_date DATE,
    FOREIGN KEY (domain_id) REFERENCES domains(id)
);

CREATE TABLE dns_records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    domain_id INT,
    record_type VARCHAR(50),
    record_value VARCHAR(255),
    FOREIGN KEY (domain_id) REFERENCES domains(id)
);

CREATE TABLE subdomains (
    id INT AUTO_INCREMENT PRIMARY KEY,
    domain_id INT,
    subdomain_name VARCHAR(255),
    FOREIGN KEY (domain_id) REFERENCES domains(id)
);

CREATE TABLE ip_info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    domain_id INT,
    ip_address VARCHAR(50),
    country VARCHAR(100),
    city VARCHAR(100),
    FOREIGN KEY (domain_id) REFERENCES domains(id)
);

CREATE TABLE open_ports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    domain_id INT,
    port_number INT,
    status VARCHAR(50),
    FOREIGN KEY (domain_id) REFERENCES domains(id)
);

CREATE TABLE tech_stack (
    id INT AUTO_INCREMENT PRIMARY KEY,
    domain_id INT,
    technology VARCHAR(255),
    FOREIGN KEY (domain_id) REFERENCES domains(id)
);