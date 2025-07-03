from pydantic import BaseModel

class SentaiBase(BaseModel):
    name: str
    color: str
    team: str
    image: str

class SentaiCreate(SentaiBase):
    pass

class SentaiUpdate(SentaiBase):
    pass

class Sentai(SentaiBase):
    id: int

    class Config:
        from_attributes = True
