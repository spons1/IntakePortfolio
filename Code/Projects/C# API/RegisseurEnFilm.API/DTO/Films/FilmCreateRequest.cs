namespace RegisseurEnFilm.API.DTO.Films
{
    public class FilmCreateRequest
    {
        public string Titel { get; set; }
        public DateTime PublicatieDatum { get; set; }
        public int RegisseurId { get; set; }
    }
}
