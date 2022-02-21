namespace Wellcome.API
{
    public class ProfileDto
    {
        public string AboutMe { get; set; }
        public AddressDto AddressDto { get; set; }
        public string Profession { get; set; }
        public List<string> Languages { get; set; }
    }
}
