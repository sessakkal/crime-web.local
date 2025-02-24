from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import csv
import time

# Configuración de opciones para ejecutar Chrome sin interfaz gráfica
chrome_options = Options()
chrome_options.add_argument("--no-sandbox")
chrome_options.add_argument("--disable-dev-shm-usage")

# Crear instancia del navegador
driver = webdriver.Chrome(options=chrome_options)

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
            title = driver.find_element(By.CLASS_NAME, "titlebar-title.titlebar-title-lg").text.strip()
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

# Función principal para extraer datos de las páginas
def extract_data_from_pages(base_url, max_pages, is_movie=True):
    data = []
    for page in range(1, max_pages + 1):
        page_url = f"{base_url}?page={page}"
        print(f"Accediendo a: {page_url}")
        driver.get(page_url)
        time.sleep(2)  # Esperar a que la página cargue

        # Extraer los enlaces de las películas o series
        if is_movie:
            item_cards = wait_for_elements(By.CLASS_NAME, "card.entity-card.entity-card-list.cf")
            item_links = [card.find_element(By.CLASS_NAME, "meta-title-link").get_attribute("href") for card in item_cards]
        else:
            item_cards = wait_for_elements(By.CLASS_NAME, "card.entity-card.entity-card-list.cf")
            item_links = [card.find_element(By.CLASS_NAME, "meta-title-link").get_attribute("href") for card in item_cards]

        # Procesar cada película o serie
        for link in item_links:
            print(f"Procesando: {link}")
            title, img_url, description = extract_data(link, is_movie)
            data.append([title, img_url, description])

    return data

# URLs base de las listas de películas y series
movies_base_url = "https://www.sensacine.com/peliculas/todas-peliculas/genero-13018/"
series_base_url = "https://www.sensacine.com/series-tv/genero-13018/"

# Extraer datos de las 5 primeras páginas de películas y series
movies_data = extract_data_from_pages(movies_base_url, 5, is_movie=True)
series_data = extract_data_from_pages(series_base_url, 5, is_movie=False)

# Combinar los datos de películas y series
all_data = movies_data + series_data

# Guardar los datos en un archivo CSV
try:
    with open('scraped_data.csv', mode='w', newline='', encoding='utf-8') as file:
        writer = csv.writer(file)
        writer.writerow(['Title', 'Image URL', 'Description'])
        writer.writerows(all_data)

    print(f"Total de items extraídos: {len(all_data)}")
    print("Datos guardados en scraped_data.csv")
except Exception as e:
    print(f"Error al guardar los datos: {e}")

# Cerrar el navegador
driver.quit()