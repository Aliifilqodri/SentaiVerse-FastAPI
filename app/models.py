from sqlalchemy import Column, Integer, String
from .database import Base

class Sentai(Base):
    __tablename__ = "sentai"

    id = Column(Integer, primary_key=True, index=True)
    name = Column(String(100))     # Tambahkan panjang
    color = Column(String(50))
    team = Column(String(100))
    image = Column(String(200))    # Untuk path gambar atau nama file
