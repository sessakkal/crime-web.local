from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import mysql.connector
import time

# Configuración de opciones para ejecutar Chrome sin interfaz gráfica
chrome_options = Options()
chrome_options.add_argument("--headless")  # Ejecutar en modo sin interfaz
chrome_options.add_argument("--no-sandbox")
chrome_options.add_argument("--disable-dev-shm-usage")

# Crear instancia del navegador
driver = webdriver.Chrome(options=chrome_options)

# Conexión a la base de datos MySQL
def connect_to_database():
    try:
        connection = mysql.connector.connect(
            host="localhost",
            user="usuario",
            password="usuario",
            database="zona_crimen"
        )
        print("Conexión a la base de datos exitosa.")
        return connection
    except mysql.connector.Error as e:
        print(f"Error al conectar a la base de datos: {e}")
        return None

# Función para esperar a que los elementos estén presentes
def wait_for_elements(by, value, timeout=10):
    return WebDriverWait(driver, timeout).until(
        EC.presence_of_all_elements_located((by, value))
    )

# Función para limpiar la descripción (eliminar saltos de línea)
def clean_description(description):
    return description.replace("\n", " ").strip()  # Reemplazar saltos de línea por espacios

# Función para extraer datos de una película o serie
def extract_data(item_url, is_movie=True):
    driver.get(item_url)
    time.sleep(2)  # Esperar a que la página cargue

    try:
        # Extraer el título
        if is_movie:
            title = driver.find_element(By.CLASS_NAME, "titlebar-title.titlebar-title-xl").text.strip()
        else:
            title = driver.find_element(By.CLASS_NAME, "titlebar-title.titlebar-title-xl").text.strip()
    except:
        title = "No disponible"

    try:
        # Extraer la URL de la imagen
        img_element = driver.find_element(By.CLASS_NAME, "thumbnail-img")
        img_url = img_element.get_attribute("src")
    except:
        img_url = "No disponible"

    try:
        # Extraer la descripción y limpiarla
        if is_movie:
            description = driver.find_element(By.ID, "synopsis-details").find_element(By.CLASS_NAME, "content-txt").text.strip()
        else:
            description = driver.find_element(By.CLASS_NAME, "content-txt").text.strip()
        description = clean_description(description)  # Limpiar la descripción
    except:
        description = "No disponible"

    return title, img_url, description

# Función para insertar datos en la base de datos
def insert_data(connection, title, img_url, description, is_movie=True):
    try:
        cursor = connection.cursor()
        if is_movie:
            query = "INSERT INTO Peliculas (titulo, imagen_url, descripcion) VALUES (%s, %s, %s)"
        else:
            query = "INSERT INTO Series (titulo, imagen_url, descripcion) VALUES (%s, %s, %s)"
        cursor.execute(query, (title, img_url, description))
        connection.commit()
        print(f"Datos insertados: {title}")
    except mysql.connector.Error as e:
        print(f"Error al insertar datos: {e}")

# Función principal para extraer datos de las páginas
def extract_data_from_pages(base_url, max_pages, is_movie=True):
    connection = connect_to_database()
    if not connection:
        return

    for page in range(1, max_pages + 1):
        page_url = f"{base_url}?page={page}"
        print(f"Accediendo a: {page_url}")
        driver.get(page_url)
        time.sleep(2)  # Esperar a que la página cargue

        # Extraer los enlaces de las películas o series
        item_cards = wait_for_elements(By.CLASS_NAME, "card.entity-card.entity-card-list.cf")
        item_links = [card.find_element(By.CLASS_NAME, "meta-title-link").get_attribute("href") for card in item_cards]

        # Procesar cada película o serie
        for link in item_links:
            print(f"Procesando: {link}")
            title, img_url, description = extract_data(link, is_movie)
            insert_data(connection, title, img_url, description, is_movie)

    connection.close()

# URLs base de las listas de películas y series
movies_base_url = "https://www.sensacine.com/peliculas/todas-peliculas/genero-13018/"
series_base_url = "https://www.sensacine.com/series-tv/genero-13018/"

# Extraer datos de las 15 primeras páginas de películas
extract_data_from_pages(movies_base_url, 15, is_movie=True)

# Extraer datos de las 15 primeras páginas de series
extract_data_from_pages(series_base_url, 15, is_movie=False)

# Cerrar el navegador
driver.quit()