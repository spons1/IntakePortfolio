namespace RegisseurEnFilm.API.DTO.Films
{
    public class FilmUpdateRequest
    {
        public int Id { get; set; }
        public string Titel { get; set; }
        public DateTime PublicatieDatum { get; set; }
        public int RegisseurId { get; set; }    
    }
}
