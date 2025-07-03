from fastapi import FastAPI, Depends, HTTPException
from sqlalchemy.orm import Session
from fastapi.middleware.cors import CORSMiddleware
from . import models, schemas, database

# Inisialisasi tabel di database
models.Base.metadata.create_all(bind=database.engine)

app = FastAPI()

# Middleware CORS supaya bisa diakses dari PHP/JS
app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],  # Bisa kamu ganti ke domain tertentu kalau sudah deploy
    allow_methods=["*"],
    allow_headers=["*"],
)

# Dependency untuk akses database
def get_db():
    db = database.SessionLocal()
    try:
        yield db
    finally:
        db.close()

# GET semua data
@app.get("/sentai/", response_model=list[schemas.Sentai])
def get_characters(db: Session = Depends(get_db)):
    return db.query(models.Sentai).all()

# POST tambah data
@app.post("/sentai/", response_model=schemas.Sentai)
def add_character(data: schemas.SentaiCreate, db: Session = Depends(get_db)):
    character = models.Sentai(**data.dict())
    db.add(character)
    db.commit()
    db.refresh(character)
    return character

# PUT update data
@app.put("/sentai/{sentai_id}")
def update_sentai(sentai_id: int, sentai: schemas.SentaiUpdate, db: Session = Depends(get_db)):
    db_data = db.query(models.Sentai).filter(models.Sentai.id == sentai_id).first()
    if not db_data:
        raise HTTPException(status_code=404, detail="Sentai not found")
    db_data.name = sentai.name
    db_data.color = sentai.color
    db_data.team = sentai.team
    db_data.image = sentai.image
    db.commit()
    return {"message": "updated"}

# DELETE hapus data
@app.delete("/sentai/{sentai_id}")
def delete_sentai(sentai_id: int, db: Session = Depends(get_db)):
    db_data = db.query(models.Sentai).filter(models.Sentai.id == sentai_id).first()
    if not db_data:
        raise HTTPException(status_code=404, detail="Sentai not found")
    db.delete(db_data)
    db.commit()
    return {"message": "deleted"}
